<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class ExpensesOverview extends BaseWidget
{
    protected static ?string $heading = 'Despesas do condomínio';

    protected int|string|array $columnSpan = [
        'default' => 1,
        'md' => 'full',
    ];

    protected function getTableHeading(): string
    {
        $count = Expense::overdue()->count();
        $label = $count === 1 ? 'vencida' : 'vencidas';
        return "Despesas do condomínio em aberto: ({$count} {$label})";
    }


    protected function getTableQuery(): Builder
    {
        $condominiumId = auth()->user()->condominium_id ?? null;

        return Expense::query()
            ->where('condominium_id', $condominiumId)
            ->where('included_in_closing', false);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('label')
                ->label('Descrição')
                ->searchable(),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->label('Status')
                ->colors([
                    'danger' => 'Vencida',
                    'warning' => 'A vencer',
                    'success' => 'Paga',
                ])
                ->icons([
                    'heroicon-o-x-circle' => 'Vencida',
                    'heroicon-o-clock' => 'A vencer',
                    'heroicon-o-check-circle' => 'Paga',
                ]),
            Tables\Columns\TextColumn::make('due_date')
                ->label('Vencimento')
                ->date('d/m/Y')
                ->sortable()
                ->color(fn ($record) =>
                $record->due_date < Carbon::today()
                    ? 'danger'  // vermelho se vencida
                    : 'warning'
                ),

            Tables\Columns\TextColumn::make('amount')
                ->label('Valor (R$)')
                ->money('BRL')
                ->sortable(),
        ];
    }


    protected function getTableFilters(): array
    {
        return [
            Tables\Filters\Filter::make('overdue')
                ->label('Somente vencidas')
                ->query(fn (Builder $query): Builder => $query->overdue())
                ->toggle(), // adiciona botão liga/desliga no topo
        ];
    }
}
