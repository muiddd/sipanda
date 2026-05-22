<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\LearningSession;
use App\Models\AiUsageLog;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // 1. Total Students
        $totalStudents = User::where('role', 'user')->count();

        // 2. Total Study Time
        $totalMinutes = LearningSession::where('status', 'completed')->sum('duration');
        $totalHours = round($totalMinutes / 60, 1);

        // 3. Total AI Requests
        $totalAiRequests = AiUsageLog::count();

        // 4. Total Tokens Consumed
        $totalTokens = AiUsageLog::sum('total_tokens');

        return [
            Stat::make('Total Siswa Aktif', $totalStudents)
                ->description('Siswa yang terdaftar di siPanda')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            
            Stat::make('Total Jam Belajar', $totalHours . ' Jam')
                ->description('Akumulasi sesi belajar mandiri')
                ->descriptionIcon('heroicon-m-clock')
                ->color('info'),

            Stat::make('Total Token AI Terpakai', number_format($totalTokens))
                ->description('Tokens yang dikonsumsi siswa')
                ->descriptionIcon('heroicon-m-cpu-chip')
                ->color('warning'),

            Stat::make('Total Request AI', $totalAiRequests)
                ->description('Rangkuman & latihan soal dibuat')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('success'),
        ];
    }
}
