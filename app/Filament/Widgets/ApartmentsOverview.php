<?php

namespace App\Filament\Widgets;

use App\Models\MonthlyClosingApartment;
use App\Models\MonthlyClosing;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ApartmentsOverview extends BaseWidget
{
    protected static ?int $sort = 5;
    protected static ?string $maxHeight = '400px';

    protected int|string|array $columnSpan = [
        'default' => 1,
        'md' => 'full',
    ];

    protected function getTableQuery(): Builder
    {
        $latestClosing = MonthlyClosing::latest('reference')->first();

        if (! $latestClosing) {
            return MonthlyClosingApartment::query()->whereNull('id');
        }

        return MonthlyClosingApartment::query()
            ->select('monthly_closing_apartments.*')
            ->join('apartments', 'apartments.id', '=', 'monthly_closing_apartments.apartment_id')
            ->where('monthly_closing_apartments.monthly_closing_id', $latestClosing->id)
            ->orderBy('apartments.identifier') // 👈 ordena pelo nome do apartamento
            ->with('apartment'); // ainda carrega o relacionamento
    }

    protected function getTableColumns(): array
    {
        return [

            TextColumn::make('monthlyClosing.reference')
                ->label('Referência')
                ->date('m/Y')
                ->alignLeft(),

            TextColumn::make('apartment.identifier')
                ->label('Apto')
                ->sortable()
                ->searchable(),

            TextColumn::make('apartment.resident_name')
                ->label('Morador')
                ->sortable()
                ->default('-'),

            TextColumn::make('amount')
                ->label('Valor (R$)')
                ->money('BRL')
                ->sortable()
                ->color(fn($record) => $record->is_paid ? Color::Green : Color::Yellow)
                ->alignRight(),

            TextColumn::make('discount')
                ->label('Desconto (R$)')
                ->money('BRL')
                ->sortable()
                ->color(fn($record) => $record->is_paid ? Color::Green : Color::Yellow)
                ->alignRight(),

            TextColumn::make('amount_final')
                ->label('Final (R$)')
                ->money('BRL')
                ->sortable()
                ->color(fn($record) => $record->is_paid ? Color::Green : Color::Yellow)
                ->alignRight(),
        ];
    }

    protected function getTableHeading(): string
    {
        $latest = MonthlyClosing::latest('reference')->first();
        return $latest
            ? "Fechamento de " . $latest->reference->format('m/Y')
            : "Fechamento por Apartamento";
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false; // mostra todos sem paginação (pode deixar true se preferir)
    }

}
