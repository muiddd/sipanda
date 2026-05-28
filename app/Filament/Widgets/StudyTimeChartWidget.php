<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\LearningSession;
use Carbon\Carbon;

class StudyTimeChartWidget extends ChartWidget
{
    protected ?string $heading = 'Tren Durasi Belajar Siswa (7 Hari Terakhir)';
    
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->translatedFormat('d M');
            
            // Mengambil data berdasarkan tanggal start_time
            $duration = LearningSession::whereDate('start_time', $date->format('Y-m-d'))
                ->where('status', 'completed')
                ->sum('duration');
                
            $data[] = $duration;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Waktu Belajar (Menit)',
                    'data' => $data,
                    'backgroundColor' => 'rgba(117, 203, 80, 0.25)',
                    'borderColor' => '#75cb50',
                    'borderWidth' => 2,
                    'borderRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
