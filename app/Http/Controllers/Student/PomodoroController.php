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

            $today = now()->startOfDay();
            
            // Cari data streak user, jika belum ada, buat instance baru
            //streak = UserStreak::firstOrNew(['user_id' => $user->id]);
            $streak = UserStreak::firstOrCreate(
                ['user_id' => $user->id], 
                [
                    'current_streak' => 0, 
                    'longest_streak' => 0, 
                    'last_activity_date' => now()->subDay()->toDateString() // Set ke kemarin agar streak jadi 1 saat diproses hari ini
                ]
            );

            if (!$streak->exists) {
                // Jika ini pertama kali user pakai timer
                $streak->current_streak = 1;
                $streak->longest_streak = 1;
                $streak->last_activity_date = $today->toDateString();
            } else {
                // Jika sudah punya riwayat, cek kapan terakhir belajar
                $lastActivity = Carbon::parse($streak->last_activity_date)->startOfDay();

                if ($lastActivity->diffInDays($today) == 1) {
                    // Kemarin belajar, hari ini belajar -> Tambah streak
                    $streak->current_streak += 1;
                    $streak->last_activity_date = $today->toDateString();
                    
                    // Cek apakah memecahkan rekor
                    if ($streak->current_streak > $streak->longest_streak) {
                        $streak->longest_streak = $streak->current_streak;
                    }
                } elseif ($lastActivity->diffInDays($today) > 1) {
                    // Bolos lebih dari 1 hari -> Reset ke 1
                    $streak->current_streak = 1;
                    $streak->last_activity_date = $today->toDateString();
                }
                // Jika diffInDays == 0 (Masih di hari yang sama belajar lagi), 
                // tidak perlu nambah streak, biarkan saja datanya.
            }
            
            $streak->save();

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
