<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Latihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class LatihanSoalController extends Controller
{
    public function index()
    {
        $materis = Materi::with('kategori')->latest()->get();
        return view('student.latihanSoal', compact('materis'));
    }

    public function show($id)
    {
        $materi = Materi::where('materi_id', $id)->firstOrFail();

        // Ambil soal dari database jika sudah pernah digenerate AI oleh user ini (atau legacy global)
        $savedSoal = Latihan::where('materi_id', $id)
            ->where(function($query) {
                $query->where('user_id', auth()->id())
                      ->orWhereNull('user_id');
            })
            ->get();

        return view('student.kuis', compact('materi', 'savedSoal'));
    }

    public function generateAi($id)
    {
        $materi = Materi::where('materi_id', $id)->firstOrFail();
        $text = strip_tags($materi->konten_teks);

        // Limiting text to prevent exceeding API limits
        $text = substr($text, 0, 10000);

        $instruction = "Kamu adalah guru pembuat soal. Buatkan 5 soal pilihan ganda berdasarkan teks berikut. WAJIB HANYA OUTPUT ARRAY JSON MURNI TANPA TEKS PENGANTAR. Format persis seperti ini: [{\"soal\":\"...\",\"opsi\":[\"A. ...\",\"B. ...\",\"C. ...\",\"D. ...\"],\"jawaban_benar\":\"A. ...\"}]";

        try {
            $aiData = \App\Services\AiService::generate($text, $instruction);
            $aiResult = $aiData['text'];

            // Clean markdown json markers if present
            $aiResult = str_replace(['```json', '```'], '', trim($aiResult));

            // Bulletproof JSON array extraction
            if (preg_match('/\[\s*\{.*\}\s*\]/s', $aiResult, $matches)) {
                $aiResult = $matches[0];
            }

            $soalJson = json_decode($aiResult, true);

            if (empty($soalJson) || !is_array($soalJson)) {
                throw new \Exception('Format soal dari AI tidak valid atau kosong: ' . substr($aiResult, 0, 100));
            }

            // Hapus soal lama untuk materi dan user ini agar tidak dobel
            Latihan::where('materi_id', $id)->where('user_id', auth()->id())->delete();

            foreach ($soalJson as $item) {
                Latihan::create([
                    'materi_id' => $id,
                    'user_id' => auth()->id(),
                    'question' => $item['soal'],
                    'options' => [
                        'pilihan' => $item['opsi'],
                        'jawaban_benar' => $item['jawaban_benar']
                    ]
                ]);
            }

            // Log AI Usage to show up in Gamifikasi stats
            try {
                \App\Models\AiUsageLog::create([
                    'user_id' => auth()->user()->id,
                    'materi_id' => $id,
                    'activity_type' => 'quiz',
                    'prompt_tokens' => $aiData['prompt_tokens'],
                    'completion_tokens' => $aiData['completion_tokens'],
                    'total_tokens' => $aiData['total_tokens'],
                ]);
            } catch (\Exception $ex) {
                // Silently ignore
            }

            return redirect()->route('student.latihansoal.show', $id)
                ->with('success', 'Soal berhasil digenerate dan disimpan ke Database!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses AI: ' . $e->getMessage());
        }
    }

    public function submitAnswers(Request $request, $id)
    {
        $answers = $request->answers;

        if (!$answers || !is_array($answers)) {
            return response()->json(['status' => 'error', 'message' => 'Data jawaban tidak valid.'], 400);
        }

        // Clear previous answers to prevent duplicates
        $latihanIds = collect($answers)->pluck('latihan_id')->toArray();
        DB::table('user_answers')
            ->where('user_id', auth()->id())
            ->whereIn('latihan_id', $latihanIds)
            ->delete();

        foreach ($answers as $ans) {
            DB::table('user_answers')->insert([
                'user_id' => auth()->id(),
                'latihan_id' => $ans['latihan_id'],
                // Ambil huruf pertama (A, B, C, D)
                'answer' => substr(trim($ans['answer']), 0, 1),
                'is_correct' => $ans['is_correct'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Jawaban berhasil disimpan ke database!']);
    }
}
