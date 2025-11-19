<?php

namespace App\Filament\Resources\MonthlyClosingDiscounts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MonthlyClosingDiscountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('monthlyClosing.reference')
                    ->label('Referência')
                    ->date('d/m/Y'),
                TextColumn::make('apartment.identifier')
                    ->label('Apartamento')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Valor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('reason')
                    ->label('Motivo')
                    ->searchable(),
                IconColumn::make('applied')
                    ->label('Aplicado')
                    ->boolean(),
                TextColumn::make('applied_at')
                    ->label('Aplicado em')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_by')
                    ->label('Creado por')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Creado em')
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
                ViewAction::make()->button(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
