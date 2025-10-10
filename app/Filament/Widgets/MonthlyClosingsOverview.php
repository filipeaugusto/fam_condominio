<?php

namespace App\Filament\Widgets;

use App\Models\MonthlyClosing;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MonthlyClosingsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        $latest = MonthlyClosing::latest('reference')->first();

        if (! $latest) {
            return [
                Stat::make('Sem dados', 'Nenhum fechamento encontrado'),
            ];
        }

        return [
            Stat::make('Mês de Referência', $latest->reference->format('m/Y')),
            Stat::make('Total Fixo', 'R$ ' . number_format($latest->total_fixed, 2, ',', '.'))
                ->description('Despesas fixas do mês')
                ->color('success'),
            Stat::make('Total Variável', 'R$ ' . number_format($latest->total_variable, 2, ',', '.'))
                ->description('Despesas variáveis'),
            Stat::make('Reserva', 'R$ ' . number_format($latest->total_reserve, 2, ',', '.'))
                ->color('info'),
            Stat::make('Emergência', 'R$ ' . number_format($latest->total_emergency, 2, ',', '.'))
                ->color('danger'),
            Stat::make('Total Geral', 'R$ ' . number_format($latest->total_amount, 2, ',', '.'))
                ->color('primary'),
        ];
    }
}
