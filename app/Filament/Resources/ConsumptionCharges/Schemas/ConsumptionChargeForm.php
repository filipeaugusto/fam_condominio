<?php

namespace App\Filament\Resources\ConsumptionCharges\Schemas;

use App\Enums\ExpenseService;
use App\Enums\ExpenseType;
use App\Models\ConsumptionCharge;
use App\Models\Expense;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class ConsumptionChargeForm
{
    public static function resetFormValues(Set $set): void
    {
        $set('service_class', 'not_apply');
        $set('previous_reading', 0);
        $set('current_reading', 0);
        $set('previous_reading_locked', false);
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('apartment_id')
                    ->relationship('apartment', 'identifier')
                    ->label('Apartamento')
                    ->live(debounce: 750)
                    ->afterStateUpdated(function ($state, Set $set) {
                        $set('expense_id', null);
                        self::resetFormValues($set);
                    })
                    ->required(),
                Select::make('expense_id')
                    ->label('Despesa variável')
                    ->options(function (Get $get) {
                        return Expense::query()
                            ->where('included_in_closing', false)
                            ->where('type', ExpenseType::VARIABLE->value)
                            ->orWhere('id', $get('expense_id') ?? 0)
                            ->pluck('label', 'id');
                    })
                    ->live(debounce: 750)
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                        self::resetFormValues($set);

                        $expense = Expense::find($state);

                        if ($expense) {
                            $set('service_class', $expense->service_class);

                            $currentCharge = ConsumptionCharge::query()
                                ->whereNot('id', $get('id') ?? 0)
                                ->where('apartment_id', $get('apartment_id'))
                                ->where('service_class', $expense->service_class)
                                ->whereNotNull('current_reading')
                                ->latest()
                                ->first();

                            if ($currentCharge) {
                                $set('previous_reading', max($currentCharge->current_reading, 0));
                                $set('previous_reading_locked', true); // define uma flag interna
                            }
                        }
                    })
                    ->required(),
                Select::make('service_class')
                    ->label('Classe de serviço')
                    ->options(ExpenseService::class)
                    ->default('not_apply')
                    ->disabled()
                    ->disabled(fn (Get $get) => $get('previous_reading_locked'))
                    ->dehydrated()
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
                    })
                    ->disabled(fn (Get $get) => $get('previous_reading_locked'))
                    ->dehydrated(),
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
                        ->disabled(fn (Get $get) => $get('previous_reading_locked'))
                        ->dehydrated()
                        ->default(0.0),

                    TextInput::make('unit_cost')
                        ->label('Custo unitário')
                        ->required()
                        ->numeric()
                        ->visibleOn('view')
                        ->default(0.0),
                    TextInput::make('total_amount')
                        ->label('Total')
                        ->required()
                        ->numeric()
                        ->visibleOn('view')
                        ->default(0.0),
            ])
            ->columns(3);
    }
}
