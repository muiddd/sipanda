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
        return view('student.latihansoal', compact('materis'));
    }

    public function show($id)
    {
        $materi = Materi::where('materi_id', $id)->firstOrFail();
        
        // Ambil soal dari database jika sudah pernah digenerate AI
        $savedSoal = Latihan::where('materi_id', $id)->get();

        return view('student.kuis', compact('materi', 'savedSoal'));
    }

    public function generateAi($id)
    {
        $materi = Materi::where('materi_id', $id)->firstOrFail();
        $text = strip_tags($materi->konten_teks); 

        $instruction = "Kamu adalah guru pembuat soal. Buatkan 5 soal pilihan ganda berdasarkan teks berikut. WAJIB HANYA OUTPUT ARRAY JSON MURNI TANPA TEKS PENGANTAR. Format persis seperti ini: [{\"soal\":\"...\",\"opsi\":[\"A. ...\",\"B. ...\",\"C. ...\",\"D. ...\"],\"jawaban_benar\":\"A. ...\"}]";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openrouter.api_key'),
                'HTTP-Referer' => config('app.url'),
                'X-Title' => 'siPanda Learning App',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'openai/gpt-oss-120b:free',
                'messages' => [
                    ['role' => 'system', 'content' => $instruction],
                    ['role' => 'user', 'content' => $text],
                ],
            ]);

            $result = $response->json();
            $aiResult = $result['choices'][0]['message']['content'] ?? '[]';
            $aiResult = str_replace(['```json', '```'], '', trim($aiResult));
            $soalJson = json_decode($aiResult, true);

            if (!$soalJson) {
                throw new \Exception('AI gagal memformat soal. Silakan coba lagi.');
            }
            
            // Hapus soal lama untuk materi ini agar tidak dobel
            Latihan::where('materi_id', $id)->delete();

            foreach ($soalJson as $item) {
                Latihan::create([
                    'materi_id' => $id,
                    'question' => $item['soal'],
                    'options' => [
                        'pilihan' => $item['opsi'],
                        'jawaban_benar' => $item['jawaban_benar']
                    ]
                ]);
            }

            // INI YANG BIKIN ERROR TADI! Harus di-redirect ke halaman GET, bukan return view!
            return redirect()->route('student.latihansoal.show', $id)
                             ->with('success', 'Soal berhasil digenerate dan disimpan ke Database!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses AI: ' . $e->getMessage());
        }
    }

    public function submitAnswers(Request $request, $id)
    {
        $answers = $request->answers;
        
        foreach($answers as $ans) {
            DB::table('user_answers')->insert([
                'user_id' => auth()->id(),
                'latihan_id' => $ans['latihan_id'],
                // Karena tabelmu formatnya char(1), kita cuma ambil huruf depannya saja (misal "A")
                'answer' => substr($ans['answer'], 0, 1), 
                'is_correct' => $ans['is_correct'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Jawaban berhasil disimpan ke database!']);
    }
}