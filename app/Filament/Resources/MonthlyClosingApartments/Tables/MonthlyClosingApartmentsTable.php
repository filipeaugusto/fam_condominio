<?php

namespace App\Filament\Resources\MonthlyClosingApartments\Tables;

use App\Filament\Resources\MonthlyClosingApartments\Actions\GenerateBilletAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\SelectColumn;
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
                SelectColumn::make('is_paid')
                    ->width(10)
                    ->visible(false)
                    ->label('Pago?')
                    ->options([
                        0 => 'Não',
                        1 => 'Sim',
                    ])
                    ->afterStateUpdated(function ($record, $state) {
                        if ($state) {
                            $record->is_paid = true;
                            $record->paid_at = now();
                        } else {
                            $record->is_paid = false;
                            $record->paid_at = null;
                        }
                        $record->save();
                    })
                    ->alignment('center'),
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
                    ->button()
                    ->color(Color::Yellow)
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['is_paid' => true, 'paid_at' => now()]);
                    })
                    ->visible(fn ($record) => ! $record->is_paid),
                ViewAction::make()->button(),
//                EditAction::make(),
                GenerateBilletAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
