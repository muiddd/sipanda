<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
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
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'action' => 'required|in:summary,quiz',
        ]);

        try {
            $parser = new Parser();
            
            // Note: Smalot PdfParser only supports PDF. 
            if ($request->file('file')->getClientOriginalExtension() !== 'pdf') {
                throw new \Exception('Maaf, saat ini siPanda baru mendukung file PDF untuk diproses AI.');
            }

            $pdf = $parser->parseFile($request->file('file')->getPathname());
            $text = $pdf->getText();

            if (empty(trim($text))) {
                throw new \Exception('Teks tidak ditemukan dalam file PDF tersebut.');
            }

            $instruction = ($request->action === 'summary') 
                ? "Rangkum teks berikut dengan poin-poin yang mudah dipahami mahasiswa:" 
                : "Buatkan 5 soal pilihan ganda berdasarkan teks berikut lengkap dengan kunci jawabannya:";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openrouter.api_key'),
                'HTTP-Referer' => config('app.url'),
                'X-Title' => 'siPanda Learning App',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'meta-llama/llama-3-8b-instruct',
                'messages' => [
                    ['role' => 'system', 'content' => $instruction],
                    ['role' => 'user', 'content' => $text],
                ],
            ]);

            $result = $response->json();
            $aiResult = $result['choices'][0]['message']['content'] ?? 'Gagal memproses.';

            echo $aiResult;

            if ($request->action === 'summary') {
                \App\Models\AiSummary::updateOrCreate(
                    ['user_id' => auth()->id()], // Cari data milik user ini
                    [
                        'summary_text' => $aiResult,
                        'last_generated' => now(),
                    ]
                );
                $message = 'Rangkuman berhasil diperbarui!';
            } else {
                return back()->with('quiz_result', $aiResult)
                             ->with('success', 'Soal latihan berhasil dibuat!');
            }

            // return back()->with('success', 'Berhasil diproses oleh siPanda AI!');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses file: ' . $e->getMessage());
        }
    }
}
