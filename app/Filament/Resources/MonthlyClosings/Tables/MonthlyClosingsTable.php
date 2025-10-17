<?php

namespace App\Filament\Resources\MonthlyClosings\Tables;

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

class MonthlyClosingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reference')
                    ->label('Referência')
                    ->date('m/Y')
                    ->sortable(),

                TextColumn::make('total_fixed')
                    ->label('Total Fixo')
                    ->money('BRL')
                    ->summarize(Sum::make())
                    ->sortable()
                    ->alignEnd(),

                TextColumn::make('total_variable')
                    ->label('Total Variável')
                    ->money('BRL')
                    ->sortable()
                    ->summarize(Sum::make())
                    ->alignEnd(),

                TextColumn::make('total_reserve')
                    ->label('Reserva')
                    ->money('BRL')
                    ->summarize(Sum::make())
                    ->alignEnd(),

                TextColumn::make('total_emergency')
                    ->label('Emergência')
                    ->money('BRL')
                    ->summarize(Sum::make())
                    ->alignEnd(),

                TextColumn::make('total_amount')
                    ->label('Total Geral')
                    ->money('BRL')
                    ->color('success')
                    ->weight('bold')
                    ->summarize(Sum::make())
                    ->alignEnd(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
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
            ])
            ->recordActions([
                ViewAction::make(),
//                EditAction::make(),
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
