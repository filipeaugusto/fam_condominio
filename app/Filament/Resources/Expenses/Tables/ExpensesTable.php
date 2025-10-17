<?php

namespace App\Filament\Resources\Expenses\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
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
                                WHEN is_paid = 1 THEN 1
                                WHEN due_date < ? THEN 2
                                ELSE 3
                            END {$direction}
                        ", [$today]);
                    })
                    // e se quiser permitir busca por texto (sobre o status), implemente query custom de search
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where(function (Builder $q) use ($search) {
                            $q->whereRaw("CASE WHEN is_paid = 1 THEN 'Paga' WHEN due_date < ? THEN 'Vencida' ELSE 'A vencer' END LIKE ?", [
                                Carbon::today()->toDateString(),
                                "%{$search}%"
                            ]);
                        });
                    }),
                IconColumn::make('included_in_closing')
                    ->label('Fechado')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
                TextColumn::make('monthlyClosing.reference')
                    ->label('referência')
                    ->date('d/m/Y')
                    ->toggleable(isToggledHiddenByDefault: true),
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
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'paga' => 'Pagas',
                        'vencida' => 'Vencidas',
                        'a_vencer' => 'A vencer',
                    ])
                    ->query(function ($query, $data) {
                        return match ($data['value'] ?? null) {
                            'paga' => $query->where('is_paid', true),
                            'vencida' => $query->where('is_paid', false)->where('due_date', '<', now()),
                            'a_vencer' => $query->where('is_paid', false)->where('due_date', '>=', now()),
                            default => $query,
                        };
                    }),
            ])
            ->recordActions([
                Action::make('markPaid')
                    ->label('Marcar como pago')
                    ->icon(Heroicon::Check)
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['is_paid' => true, 'paid_at' => now()]);
                    })
                    ->visible(fn ($record) => ! $record->is_paid && $record->included_in_closing),
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
