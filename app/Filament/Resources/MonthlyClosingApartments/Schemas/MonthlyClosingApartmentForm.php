<?php

namespace App\Filament\Resources\MonthlyClosingApartments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MonthlyClosingApartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('monthly_closing_id')
                    ->relationship('monthlyClosing', 'reference')
                    ->label('Fechamento Mensal')
                    ->required(),
                Select::make('apartment_id')
                    ->relationship('apartment', 'identifier')
                    ->label('Apartamento')
                    ->required(),
                TextInput::make('amount')
                    ->label('Valor (R$)')
                    ->numeric()
                    ->prefix('R$')
                    ->default(0)
                    ->rules(['numeric', 'min:0']),
                TextInput::make('discount')
                    ->label('Desconto (R$)')
                    ->numeric()
                    ->prefix('R$')
                    ->default(0)
                    ->rules(['numeric', 'min:0'])
                    ->columnSpan(1),

            ]);
    }
}
