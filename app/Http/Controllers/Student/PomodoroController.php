<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LearningSession;
use App\Models\UserStreak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PomodoroController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'duration' => 'required|integer', // Mengambil durasi belajar (25 menit)
            'materi_id' => 'nullable|exists:materis,materi_id' // Opsional jika terikat materi
        ]);

        try {
            // Karena request dikirim setelah siklus 30 menit (25 + 5) selesai:
            $endTime = now();
            $startTime = now()->subMinutes(30); // Waktu mulai adalah 30 menit yang lalu

            $session = LearningSession::create([
                'materi_id' => $request->materi_id, // Bisa null
                'user_id' => Auth::id(),
                'start_time' => $startTime,
                'end_time' => $endTime,
                'duration' => $request->duration, // Menyimpan angka 25
                'status' => 'completed' // Otomatis completed
            ]);

            Auth::user()->updateStreak();

            return response()->json([
                'success' => true,
                'message' => 'Siklus Pomodoro berhasil disimpan!',
                'session' => $session
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan sesi belajar: ' . $e->getMessage()
            ], 500);
        }
    }
}
