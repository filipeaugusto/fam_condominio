<?php

namespace App\Filament\Widgets;

use App\Models\MonthlyClosing;
use Filament\Widgets\ChartWidget;

class MonthlyClosingsChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'Evolução';

    protected static ?string $description = 'Evolução dos fechamentos mensais';

    protected static ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $closings = MonthlyClosing::orderBy('reference')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Geral',
                    'data' => $closings->pluck('total_amount'),
                ],
            ],
            'labels' => $closings->pluck('reference')->map(fn($date) => \Carbon\Carbon::parse($date)->format('m/Y')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

