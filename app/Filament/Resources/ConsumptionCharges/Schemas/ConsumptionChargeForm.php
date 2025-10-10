<?php

namespace App\Filament\Resources\ConsumptionCharges\Schemas;

use App\Enums\ExpenseService;
use App\Enums\ExpenseType;
use App\Models\Expense;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class ConsumptionChargeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('apartment_id')
                    ->relationship('apartment', 'identifier')
                    ->label('Apartamento')
                    ->required(),
                Select::make('expense_id')
                    ->label('Despesa variável')
                    ->options(function () {
                        return Expense::query()
                            ->where('included_in_closing', false)
                            ->where('type', ExpenseType::VARIABLE->value)
                            ->pluck('label', 'id');
                    })
                    ->required(),
                Select::make('service_class')
                    ->label('Classe de serviço')
                    ->options(ExpenseService::class)
                    ->default('not_apply')
                    ->required(),
                TextInput::make('previous_reading')
                    ->label('Leitura anterior')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->live(debounce: 750)
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                        $previous = (float) $state;
                        $current = (float) $get('current_reading');
                        $set('consumption', max($current - $previous, 0));
                    }),
                TextInput::make('current_reading')
                    ->label('Leitura atual')
                    ->required()
                    ->numeric()
                    ->default(0)
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
                TextInput::make('consumption')
                    ->label('Consumo (m³)')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('unit_cost')
                    ->label('Custo unitário')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_amount')
                    ->label('Total')
                    ->required()
                    ->numeric()
                    ->default(0.0),
            ]);
    }
}
