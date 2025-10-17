<?php

namespace App\Filament\Resources\ConsumptionCharges\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ConsumptionChargesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('apartment.identifier')
                    ->label('Apartamento')
                    ->searchable(),
                TextColumn::make('expense.label')
                    ->label('Despesa variável')
                    ->searchable(),
                TextColumn::make('service_class')
                    ->label('Classe de serviço')
                    ->badge(),
                TextColumn::make('previous_reading')
                    ->label('Leitura anterior')
//                    ->numeric()
                    ->sortable(),
                TextColumn::make('current_reading')
                    ->label('Leitura atual')
//                    ->numeric()
                    ->sortable(),
                TextColumn::make('consumption')
                    ->label('Consumo')
//                    ->numeric()
                    ->sortable(),
                TextColumn::make('unit_cost')
                    ->label('Custo')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->numeric()
                    ->money("BRL")
                    ->summarize(Sum::make())
                    ->sortable(),
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
                TextColumn::make('deleted_at')
                    ->label('Deletado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
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
