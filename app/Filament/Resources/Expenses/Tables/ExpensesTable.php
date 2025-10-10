<?php

namespace App\Filament\Resources\Expenses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;

class ExpensesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('condominium.name')
                    ->label('Condomínio')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge(),
                TextColumn::make('service_class')
                    ->label('Classe')
                    ->badge(),
                TextColumn::make('label')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Valor')
                    ->numeric()
                    ->money("BRL")
                    ->summarize(Sum::make())
                    ->numeric()
                    ->sortable(),
                TextColumn::make('due_date')
                    ->label('Dt. vencimento')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('status')
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
                    ])
                    // se quiser permitir ordenação por "status" (virtual), implemente uma query custom:
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        // mapear status para ordem: Paga(1), Vencida(2), A vencer(3)
                        $today = Carbon::today()->toDateString();
                        return $query->orderByRaw("
                            CASE
                                WHEN included_in_closing = 1 THEN 1
                                WHEN due_date < ? THEN 2
                                ELSE 3
                            END {$direction}
                        ", [$today]);
                    })
                    // e se quiser permitir busca por texto (sobre o status), implemente query custom de search
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where(function (Builder $q) use ($search) {
                            $q->whereRaw("CASE WHEN included_in_closing = 1 THEN 'Paga' WHEN due_date < ? THEN 'Vencida' ELSE 'A vencer' END LIKE ?", [
                                Carbon::today()->toDateString(),
                                "%{$search}%"
                            ]);
                        });
                    }),
                IconColumn::make('included_in_closing')
                    ->label('Fechado')
                    ->boolean(),
                TextColumn::make('monthlyClosing.reference')
                    ->label('referência')
                    ->date('d/m/Y'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
