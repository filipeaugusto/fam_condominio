<?php

namespace App\Filament\Resources;

use App\Enums\ExpenseType;
use App\Filament\Resources\ConsumptionChargeResource\Pages;
use App\Models\ConsumptionCharge;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ConsumptionChargeResource extends Resource
{
    protected static ?string $model = ConsumptionCharge::class;
    protected static ?int $navigationSort = 5;
    protected static ?string $modelLabel = 'Despesa por rateio';
    protected static ?string $pluralLabel = 'Despesas por rateio';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('apartment_id')
                    ->relationship('apartment', 'identifier')
                    ->label('Apartamento')
                    ->required(),
                Forms\Components\Select::make('expense_id')
                    ->label('Despesa variável')
                    ->options(function () {
                        return Expense::query()
                            ->where('included_in_closing', false)
                            ->where('type', ExpenseType::VARIABLE->value)
                            ->pluck('label', 'id');
                    })
                    ->required(),
                Forms\Components\TextInput::make('previous_reading')
                    ->label('Leitura anterior')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('current_reading')
                    ->label('Leitura atual')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('consumption')
                    ->label('Consumo')
                    ->default(0)
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('unit_cost')
                    ->label('Custo unitário')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('total_amount')
                    ->label('Total')
                    ->required()
                    ->numeric()
                    ->default(0.00),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('apartment.identifier')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expense.label')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('previous_reading')
//                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('current_reading')
//                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('consumption')
//                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit_cost')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConsumptionCharges::route('/'),
            'create' => Pages\CreateConsumptionCharge::route('/create'),
            'edit' => Pages\EditConsumptionCharge::route('/{record}/edit'),
        ];
    }
}
