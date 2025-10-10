<?php

namespace App\Filament\Widgets;

use App\Models\MonthlyClosing;
use Filament\Widgets\ChartWidget;

class MonthlyClosingsChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Evolução dos fechamentos mensais';

    protected ?string $description = 'Evolução dos fechamentos mensais';

    protected ?string $maxHeight = '400px';

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

