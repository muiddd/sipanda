<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningSession;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GamifikasiController extends Controller
{
    public function index()
    {
        $learningSessions = LearningSession::where('user_id', auth()->user()->id)
            ->where('start_time', '>=', now()->subDays(6)->startOfDay())
            ->get()
            ->groupBy(function($session) {
                return Carbon::parse($session->start_time)->format('Y-m-d');
            });
            
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = now()->subDays($i)->translatedFormat('D');
            $chartData[] = isset($learningSessions[$date]) ? $learningSessions[$date]->sum('duration') : 0;
        }

        $totalMinutes = LearningSession::where('user_id', auth()->user()->id)->where('status', 'completed')->sum('duration');
        $hours = floor($totalMinutes / 60);
        $mins = $totalMinutes % 60;

        return view('student.gamifikasi', compact('chartLabels', 'chartData', 'hours', 'mins'));
    }

    public function storeLearningSession(Request $request)
    {
        $request->validate([
            'duration' => 'required|integer|min:1',
            'materi_id' => 'nullable|exists:materis,id'
        ]);

        LearningSession::create([
            'user_id' => auth()->user()->id,
            'materi_id' => $request->input('materi_id') ?: 1, 
            'start_time' => now()->subMinutes($request->duration),
            'end_time' => now(),
            'duration' => $request->duration,
            'status' => 'completed',
        ]);

        return response()->json(['success' => true, 'message' => 'Sesi belajar berhasil disimpan!']);
    }
}