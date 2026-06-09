<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\AiSummary;
use Smalot\PdfParser\Parser;

class ChatController extends Controller
{
    public function index()
    {
        $chats = ChatMessage::where('user_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get();

        $summary = AiSummary::where('user_id', auth()->id())->latest()->first();

        return view('student.dashboard', compact('chats', 'summary'));
    }



    public function processAi(Request $request)
    {
        if ($request->has('materi_id')) {
            try {
                // 1. Ambil teks asli dari database
                $materi = \App\Models\Materi::findOrFail($request->materi_id);
                $teksMateri = strip_tags($materi->konten_teks);

                // 2. Siapkan perintah untuk AI
                $instruction = "Kamu adalah asisten guru yang ahli merangkum. Buatlah rangkuman eksekutif dari teks materi berikut. Gunakan bahasa Indonesia yang mudah dipahami, poin-poin yang jelas, dan fokus pada inti materi saja.";

                // 3. Tembak ke AI Service
                $aiData = \App\Services\AiService::generate($teksMateri, $instruction);
                $aiSummary = $aiData['text'];

                // 4. Simpan ke database ai_summaries agar bisa diekspor ke Buku Catatan
                $summaryModel = \App\Models\AiSummary::updateOrCreate(
                    [
                        'user_id' => auth()->id(),
                        'materi_id' => $materi->materi_id,
                    ],
                    [
                        'summary_text' => $aiSummary,
                        'last_generated' => now(),
                    ]
                );

                // Log AI Usage
                try {
                    \App\Models\AiUsageLog::create([
                        'user_id' => auth()->user()->id,
                        'materi_id' => $materi->materi_id,
                        'activity_type' => 'summary',
                        'prompt_tokens' => $aiData['prompt_tokens'],
                        'completion_tokens' => $aiData['completion_tokens'],
                        'total_tokens' => $aiData['total_tokens'],
                    ]);
                } catch (\Exception $ex) {}

                // 5. Kembalikan ke halaman Ruang Baca dengan membawa data rangkuman dan ID
                return back()->with([
                    'ai_summary' => $aiSummary,
                    'summaries_id' => $summaryModel->summaries_id
                ]);

            } catch (\Exception $e) {
                return back()->with('error', 'Gagal memproses AI: ' . $e->getMessage());
            }
        }

        $request->validate([
            'file' => 'required|file|mimes:pdf|max:10240',
            'action' => 'required|in:summary,quiz',
        ]);

        try {
            $parser = new Parser();

            // Note: Smalot PdfParser only supports PDF. 
            if ($request->file('file')->getClientOriginalExtension() !== 'pdf') {
                throw new \Exception('Maaf, saat ini siPanda baru mendukung file PDF untuk diproses AI.');
            }

            $pdf = $parser->parseFile($request->file('file')->getPathname());

            // Batasi teks agar tidak melebihi limit token API OpenRouter
            $text = substr($pdf->getText(), 0, 15000);

            if (empty(trim($text))) {
                throw new \Exception('Teks tidak ditemukan dalam file PDF tersebut.');
            }

            $instruction = ($request->action === 'summary')
                ? "Rangkum teks berikut dengan poin-poin yang mudah dipahami mahasiswa:"
                : "Buatkan 5 soal pilihan ganda berdasarkan teks berikut. WAJIB format JSON murni [{\"soal\":\"...\",\"opsi\":[\"A...\",\"B...\"],\"jawaban_benar\":\"A...\"}]:";

            // 3. Tembak ke AI Service
            $aiData = \App\Services\AiService::generate($text, $instruction);
            $aiResult = $aiData['text'];

            // Log AI Usage
            try {
                $materi = \App\Models\Materi::first();
                $materiId = $materi ? $materi->materi_id : 1;
                
                \App\Models\AiUsageLog::create([
                    'user_id' => auth()->user()->id,
                    'materi_id' => $materiId,
                    'activity_type' => $request->action,
                    'prompt_tokens' => $aiData['prompt_tokens'],
                    'completion_tokens' => $aiData['completion_tokens'],
                    'total_tokens' => $aiData['total_tokens'],
                ]);
            } catch (\Exception $ex) {
                // Silently ignore
            }

            if ($request->action === 'summary') {
                \App\Models\AiSummary::updateOrCreate(
                    ['user_id' => auth()->user()->id],
                    [
                        'summary_text' => $aiResult,
                        'last_generated' => now(),
                    ]
                );
                return back()->with('success', 'Rangkuman berhasil diperbarui!');
            } else {
                return back()->with('quiz_result', $aiResult)
                    ->with('success', 'Soal latihan berhasil dibuat!');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses file: ' . $e->getMessage());
        }
    }

}
