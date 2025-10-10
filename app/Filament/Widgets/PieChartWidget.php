<?php

namespace App\Filament\Widgets;

use App\Models\MonthlyClosing;
use Filament\Widgets\ChartWidget;

class PieChartWidget extends ChartWidget
{
    protected static ?int $sort = 3;

    protected ?string $heading = 'Composição do último fechamento';

//    protected ?string $description = 'Composição do último fechamento';

    protected ?string $maxHeight = '200px';

    protected function getData(): array
    {
        $latest = MonthlyClosing::latest('reference')->first();

        if (! $latest) {
            return ['datasets' => [], 'labels' => []];
        }

        return [
            'datasets' => [
                [
                    'data' => [
                        $latest->total_fixed,
                        $latest->total_variable,
                        $latest->total_reserve,
                        $latest->total_emergency,
                    ],
                    'backgroundColor' => ['#22c55e', '#eab308', '#3b82f6', '#ef4444'],
                ],
            ],
            'labels' => ['Fixas', 'Variáveis', 'Reserva', 'Emergência'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
