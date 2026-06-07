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

    public function todo()
    {
        return view('student.targetBelajar');
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

                // 3. Tembak ke OpenRouter AI
                $response = Http::timeout(120)->withHeaders([
                    'Authorization' => 'Bearer ' . config('services.openrouter.api_key'),
                    'HTTP-Referer' => config('app.url'),
                    'X-Title' => 'siPanda Learning App',
                ])->post('https://openrouter.ai/api/v1/chat/completions', [
                    'model' => 'openai/gpt-oss-120b:free', 
                    'messages' => [
                        ['role' => 'system', 'content' => $instruction],
                        ['role' => 'user', 'content' => $teksMateri],
                    ],
                ]);

                $result = $response->json();
                $aiSummary = $result['choices'][0]['message']['content'] ?? 'Gagal membuat rangkuman.';

                // 4. Kembalikan ke halaman Ruang Baca dengan membawa data rangkuman
                return back()->with('ai_summary', $aiSummary);

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
            $aiResult = $result['choices'][0]['message']['content'] ?? 'Gagal memproses.';

            // Log AI Usage
            try {
                $materi = \App\Models\Materi::first();
                $materiId = $materi ? $materi->materi_id : 1;
                
                $usage = $result['usage'] ?? [];
                $promptTokens = $usage['prompt_tokens'] ?? str_word_count($text);
                $completionTokens = $usage['completion_tokens'] ?? str_word_count($aiResult);
                $totalTokens = $usage['total_tokens'] ?? ($promptTokens + $completionTokens);
                
                \App\Models\AiUsageLog::create([
                    'user_id' => auth()->user()->id,
                    'materi_id' => $materiId,
                    'activity_type' => $request->action,
                    'prompt_tokens' => $promptTokens,
                    'completion_tokens' => $completionTokens,
                    'total_tokens' => $totalTokens,
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
