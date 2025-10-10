<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonthlyClosingResource\Pages;
use App\Models\MonthlyClosing;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MonthlyClosingResource extends Resource
{
    protected static ?string $model = MonthlyClosing::class;

    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Fechamentos mensais';
    protected static ?string $pluralModelLabel = 'Fechamentos mensais';
    protected static ?string $modelLabel = 'Fechamento mensal';
    protected static ?string $navigationGroup = 'Financeiro';

    public static function table(Table $table): Table
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
            ])

            // 🔍 FILTROS
            ->filters([
                Filter::make('reference_range')
                    ->form([
                        Forms\Components\DatePicker::make('start')
                            ->label('De'),
                        Forms\Components\DatePicker::make('end')
                            ->label('Até'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['start'], fn ($q) => $q->whereDate('reference', '>=', $data['start']))
                            ->when($data['end'], fn ($q) => $q->whereDate('reference', '<=', $data['end']));
                    })
                    ->label('Período'),
            ])
            ->defaultSort('reference', 'desc')
            ->actions([
            ])
            ->bulkActions([
//                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMonthlyClosings::route('/'),
        ];
    }
}
