<?php

namespace App\Filament\Resources\MonthlyClosingApartments\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MonthlyClosingApartmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('monthlyClosing.reference')
                    ->label('Mês de referência')
                    ->date('d/m/Y')
                    ->searchable(),
                TextColumn::make('apartment.identifier')
                    ->label('Apartamento')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Total')
                    ->numeric()
                    ->money("BRL")
                    ->summarize(Sum::make())
                    ->sortable(),
                TextColumn::make('discount')
                    ->label('Desconto')
                    ->numeric()
                    ->money("BRL")
                    ->summarize(Sum::make())
                    ->sortable(),
                TextColumn::make('amount_final')
                    ->label('Valor Final')
                    ->numeric()
                    ->money("BRL")
                    ->summarize(Sum::make())
                    ->sortable()
                    ->color(function ($record) {
                        return $record->is_paid ? Color::Green : Color::Yellow;
                    }),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('markPaid')
                    ->label('Marcar como pago')
                    ->icon(Heroicon::Check)
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['is_paid' => true, 'paid_at' => now()]);
                    })
                    ->visible(fn ($record) => ! $record->is_paid),
                ViewAction::make(),
//                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
