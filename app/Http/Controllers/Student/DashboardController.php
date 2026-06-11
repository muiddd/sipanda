<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\AiSummary;
use App\Models\Todo;
use App\Models\BukuCatatan;
use App\Models\LearningSession;
use App\Models\StudySession;

class DashboardController extends Controller
{
    public function index()
    {
        auth()->user()->updateStreak();

        $userId = auth()->user()->id;

        $chats = ChatMessage::where('user_id', $userId)
                    ->orderBy('created_at', 'asc')->get();
        $summary = AiSummary::where('user_id', $userId)->latest()->first();

        // 1. Target Belajar (Todo)
        $todoTotal = Todo::where('user_id', $userId)->count();
        $todoDone = Todo::where('user_id', $userId)->where('done', true)->count();
        $todoPercentage = $todoTotal > 0 ? round(($todoDone / $todoTotal) * 100) : 0;

        // 2. Waktu Belajar (Study Time)
        $learningDuration = LearningSession::where('user_id', $userId)
            ->where('status', 'completed')
            ->sum('duration') ?? 0;

        $studySessions = StudySession::where('user_id', $userId)->get();
        $studyDuration = $studySessions->sum(fn($session) => $session->duration);

        $totalStudyTime = $learningDuration + $studyDuration;
        $totalSessionsCount = LearningSession::where('user_id', $userId)->where('status', 'completed')->count() + $studySessions->count();

        // 3. Buku Catatan (Notes)
        $totalNotes = BukuCatatan::where('user_id', $userId)->count();

        return view('student.dashboard', compact(
            'chats', 
            'summary',
            'todoTotal',
            'todoDone',
            'todoPercentage',
            'totalStudyTime',
            'totalSessionsCount',
            'totalNotes'
        ));
    }
}