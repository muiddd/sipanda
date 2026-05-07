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

    public function gamifikasi()
    {
        // Data for Learning Session Chart
        $learningSessions = \App\Models\LearningSession::where('user_id', auth()->id())
            ->where('start_time', '>=', now()->subDays(6)->startOfDay())
            ->get()
            ->groupBy(function($session) {
                return \Carbon\Carbon::parse($session->start_time)->format('Y-m-d');
            });

        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $label = now()->subDays($i)->translatedFormat('D'); // Mon, Tue, etc.
            $chartLabels[] = $label;
            
            $duration = isset($learningSessions[$date]) ? $learningSessions[$date]->sum('duration') : 0;
            $chartData[] = $duration;
        }

        $totalMinutes = \App\Models\LearningSession::where('user_id', auth()->id())->where('status', 'completed')->sum('duration');
        $hours = floor($totalMinutes / 60);
        $mins = $totalMinutes % 60;

        return view('student.gamifikasi', compact('chartLabels', 'chartData', 'hours', 'mins'));
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
                'model' => 'openai/gpt-oss-120b:free',
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
                    ['user_id' => auth()->id()], 
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

    public function storeLearningSession(Request $request)
    {
        $request->validate([
            'duration' => 'required|integer|min:1',
            // materi_id can be optional or handled if present
            'materi_id' => 'nullable|exists:materis,materi_id'
        ]);

        $duration = $request->input('duration');
        
        \App\Models\LearningSession::create([
            'user_id' => auth()->id(),
            'materi_id' => $request->input('materi_id') ?: 1, // Defaulting to 1 for dummy/general session
            'start_time' => now()->subMinutes($duration),
            'end_time' => now(),
            'duration' => $duration,
            'status' => 'completed',
        ]);

        return response()->json(['success' => true, 'message' => 'Sesi belajar berhasil disimpan!']);
    }
}
