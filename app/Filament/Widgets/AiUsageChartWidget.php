<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\AiUsageLog;
use Carbon\Carbon;

class AiUsageChartWidget extends ChartWidget
{
    protected ?string $heading = 'Tren Penggunaan AI siPanda (7 Hari Terakhir)';
    
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $summaryData = [];
        $quizData = [];
        $labels = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->translatedFormat('d M');
            
            $summaryCount = AiUsageLog::whereDate('created_at', $date->format('Y-m-d'))
                ->where('activity_type', 'summary')
                ->count();
                
            $quizCount = AiUsageLog::whereDate('created_at', $date->format('Y-m-d'))
                ->where('activity_type', 'quiz')
                ->count();

            $summaryData[] = $summaryCount;
            $quizData[] = $quizCount;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Rangkuman AI',
                    'data' => $summaryData,
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
                [
                    'label' => 'Latihan Soal AI',
                    'data' => $quizData,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
