<?php

namespace App\Filament\Pages;

class Dashboard extends \Filament\Pages\Dashboard
{
    /**
     * @return array<class-string<\Filament\Widgets\Widget>>
     */
    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\CustomAccountWidget::class,
            \App\Filament\Widgets\AdminStatsWidget::class,
            \App\Filament\Widgets\StudyTimeChartWidget::class,
            \App\Filament\Widgets\AiUsageChartWidget::class,
        ];
    }
}
