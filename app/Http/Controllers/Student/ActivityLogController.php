<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudySession;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function index()
    {   
        $user = Auth::user();

        // --- Stat cards ---
        $today       = Carbon::today();
        $todaySessions = StudySession::where('user_id', $user->id)
            ->whereDate('started_at', $today)
            ->get();

        $todayMinutes = $todaySessions->sum(fn($s) => $s->started_at->diffInMinutes($s->ended_at));
        $todayCount   = $todaySessions->count();
        $avgFocus     = $todaySessions->avg('focus_score') ?? 0;

        $weekMinutes = StudySession::where('user_id', $user->id)
            ->whereBetween('started_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get()
            ->sum(fn($s) => $s->started_at->diffInMinutes($s->ended_at));

        // --- Streak hitung mundur ---
        $user->updateStreak();
        $streak = $user->streak->current_streak ?? 0;

        // --- Heatmap: 30 hari terakhir ---
        // Format: ['2026-05-08' => 94, '2026-05-09' => 0, ...]
        $period = CarbonPeriod::create(Carbon::today()->subDays(29), Carbon::today());

        $rawSessions = StudySession::where('user_id', $user->id)
            ->where('started_at', '>=', Carbon::today()->subDays(29))
            ->get();

        $minutesByDate = $rawSessions->groupBy(fn($s) => $s->started_at->toDateString())
            ->map(fn($group) => $group->sum(fn($s) => $s->started_at->diffInMinutes($s->ended_at)));

        $heatmap = [];
        foreach ($period as $date) {
            $key = $date->toDateString();
            $heatmap[$key] = $minutesByDate[$key] ?? 0;
        }

        // Normalisasi ke level 0-4 untuk warna
        $maxMinutes = max($minutesByDate->max() ?? 1, 1);
        $heatmapLevels = collect($heatmap)->map(fn($m) => match (true) {
            $m === 0       => 0,
            $m < $maxMinutes * 0.25 => 1,
            $m < $maxMinutes * 0.5  => 2,
            $m < $maxMinutes * 0.75 => 3,
            default        => 4,
        })->toArray();

        // --- Distribusi mapel (minggu ini) ---
        $weekSessions = StudySession::where('user_id', $user->id)
            ->whereBetween('started_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();

        $totalWeekMinutes = $weekSessions->sum(fn($s) => $s->started_at->diffInMinutes($s->ended_at)) ?: 1;
        $subjectBreakdown = $weekSessions
            ->groupBy('subject')
            ->map(fn($group) => [
                'minutes'  => $group->sum(fn($s) => $s->started_at->diffInMinutes($s->ended_at)),
                'percent'  => round($group->sum(fn($s) => $s->started_at->diffInMinutes($s->ended_at)) / $totalWeekMinutes * 100),
            ])
            ->sortByDesc('minutes')
            ->take(5);

        // --- Timeline sesi (dikelompokkan per hari) ---
        $sessions = StudySession::where('user_id', $user->id)
            ->orderByDesc('started_at')
            ->take(30)
            ->get()
            ->groupBy(fn($s) => $s->started_at->toDateString());

        return view('student.activityLog', compact(
            'todayMinutes',
            'todayCount',
            'avgFocus',
            'weekMinutes',
            'streak',
            'heatmapLevels',
            'subjectBreakdown',
            'sessions',
        ));
    }

    public function store()
    {
        request()->validate([
            'subject'    => 'required|string|max:100',
            'topic'      => 'nullable|string|max:200',
            'started_at' => 'required|date',
            'ended_at'   => 'required|date|after:started_at',
            'focus_score' => 'nullable|integer|min:0|max:100',
        ]);

        StudySession::create([
            'user_id'     => Auth::id(),
            'subject'     => request('subject'),
            'topic'       => request('topic'),
            'started_at'  => request('started_at'),
            'ended_at'    => request('ended_at'),
            'focus_score' => request('focus_score', 0),
        ]);

        Auth::user()->updateStreak();

        return back()->with('success', 'Sesi belajar berhasil dicatat!');
    }

    // Fungsi baru untuk menerima data otomatis via AJAX dari browser
    public function storeAuto()
    {
        request()->validate([
            'subject'     => 'required|string|max:100',
            'topic'       => 'nullable|string|max:200',
            'started_at'  => 'required|date',
            'ended_at'    => 'required|date', // 'after:started_at' kita lepas dulu agar lebih fleksibel saat testing auto-log
            'focus_score' => 'nullable|integer|min:0|max:100',
        ]);

        StudySession::create([
            'user_id'     => Auth::id(),
            'subject'     => request('subject'),
            'topic'       => request('topic'),
            'started_at'  => request('started_at'),
            'ended_at'    => request('ended_at'),
            'focus_score' => request('focus_score', 0),
        ]);

        Auth::user()->updateStreak(); // Update streak otomatis setiap selesai baca

        return response()->json(['status' => 'success', 'message' => 'Sesi belajar otomatis dicatat!']);
    }
}
