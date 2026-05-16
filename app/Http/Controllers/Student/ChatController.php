<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\AiSummary;
use Smalot\PdfParser\Parser;

class ChatController extends Controller
{
    public function processAi(Request $request)
    {
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