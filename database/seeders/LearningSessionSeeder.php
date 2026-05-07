<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LearningSession;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LearningSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('role', 'user')->first();
        if (!$user) {
            return; // Pastikan user ada
        }

        // Cari atau buat materi dummy untuk menghindari foreign key constraint error
        $materi = DB::table('materis')->first();
        $materi_id = 1;
        
        if ($materi) {
            // Kita harus mengambil field primary key, biasanya materi_id
            $materi_id = isset($materi->materi_id) ? $materi->materi_id : (isset($materi->id) ? $materi->id : 1);
        } else {
            // Bypass jika tabel kosong (Asumsi)
            try {
                $materi_id = DB::table('materis')->insertGetId([
                    'kategori_id' => 1,
                    'judul' => 'Materi Default untuk Seeder',
                    'deskripsi' => 'Deskripsi default',
                    'file_path' => 'dummy.pdf',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Ignore jika fk error
            }
        }

        // Buat data 7 hari kebelakang
        for ($i = 6; $i >= 0; $i--) {
            // Simulasi hari
            $date = Carbon::now()->subDays($i)->setHour(rand(8, 20))->setMinute(rand(0, 59));
            $duration = rand(30, 150); // Lama belajar random antara 30-150 menit

            LearningSession::create([
                'materi_id' => $materi_id,
                'user_id' => $user->id,
                'start_time' => $date,
                'end_time' => (clone $date)->addMinutes($duration),
                'duration' => $duration,
                'status' => 'completed',
            ]);
        }
    }
}
