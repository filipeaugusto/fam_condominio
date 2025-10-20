<?php

namespace App\Filament\Widgets;

use App\Enums\ExpenseType;
use App\Models\MonthlyClosing;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MonthlyClosingsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected ?string $heading = 'Visão geral do último fechamento mensal';

    protected function getCards(): array
    {
        $latest = MonthlyClosing::latest('reference')->first();

        if (! $latest) {
            return [
                Stat::make('Sem dados', 'Nenhum fechamento encontrado'),
            ];
        }

        return [
            Stat::make('Mês de Referência', $latest->reference->format('m/Y'))
                ->description('Mês do fechamento mensal')
                ->color(Color::Gray),
            Stat::make('Total Fixo', 'R$ ' . number_format($latest->total_fixed, 2, ',', '.'))
                ->description('Despesas fixas do mês')
                ->color(ExpenseType::from('fixed')->getColor()),
            Stat::make('Total Variável', 'R$ ' . number_format($latest->total_variable, 2, ',', '.'))
                ->description('Despesas variáveis')
                ->color(ExpenseType::from('variable')->getColor()),
            Stat::make('Reserva', 'R$ ' . number_format($latest->total_reserve, 2, ',', '.'))
                ->description('Reserva')
                ->color(ExpenseType::from('reserve')->getColor()),
            Stat::make('Emergência', 'R$ ' . number_format($latest->total_emergency, 2, ',', '.'))
                ->description('Emergência')
                ->color(ExpenseType::from('emergency')->getColor()),
            Stat::make('Total Geral', 'R$ ' . number_format($latest->total_amount, 2, ',', '.'))
                ->description('Total Geral')
                ->color(Color::Teal),
        ];
    }
}
