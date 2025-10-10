<?php

namespace App\Filament\Resources;

use App\Enums\ExpenseType;
use App\Filament\Resources\ConsumptionChargeResource\Pages;
use App\Models\ConsumptionCharge;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;

class ConsumptionChargeResource extends Resource
{
    protected static ?string $model = ConsumptionCharge::class;
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'Despesa por rateio';
    protected static ?string $pluralLabel = 'Despesas por rateio';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Despesas por rateio';
    protected static ?string $pluralModelLabel = 'Despesas por rateio';
    protected static ?string $navigationGroup = 'Financeiro';

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
                    ->numeric()
                    ->default(0)
                    ->live(debounce: 750)
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                        $previous = (float) $state;
                        $current = (float) $get('current_reading');
                        $set('consumption', max($current - $previous, 0));
                    }),
                Forms\Components\TextInput::make('current_reading')
                    ->label('Leitura atual')
                    ->numeric()
                    ->required()
                    ->live(debounce: 750)
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                        $previous = (float) $get('previous_reading');
                        $current = (float) $state;
                        $set('consumption', max($current - $previous, 0));
                    })
                    ->rule(function (Get $get) {
                        return function (string $attribute, $value, $fail) use ($get) {
                            if ($value < $get('previous_reading')) {
                                $fail('A leitura atual deve ser maior ou igual a leitura anterior.');
                            }
                        };
                    }),
                Forms\Components\TextInput::make('consumption')
                    ->label('Consumo (m³)')
                    ->numeric()
                    ->readOnly() // não editável manualmente
                    ->dehydrated(true) // salva no banco
                    ->default(0),
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
                    ->label('Apartamento')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expense.label')
                    ->label('Despesa variável')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('previous_reading')
                    ->label('Leitura anterior')
                    ->sortable(),
                Tables\Columns\TextColumn::make('current_reading')
                    ->label('Leitura atual')
                    ->sortable(),
                Tables\Columns\TextColumn::make('consumption')
                    ->label('Consumo')
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit_cost')
                    ->label('Custo')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total')
                    ->numeric()
                    ->money("BRL")
                    ->summarize(Sum::make())
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Deletado em')
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
