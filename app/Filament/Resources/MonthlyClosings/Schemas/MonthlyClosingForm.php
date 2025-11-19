<?php

namespace App\Filament\Resources\MonthlyClosings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MonthlyClosingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('condominium_id')
                    ->relationship('condominium', 'name')
                    ->label('Condomínio')
                    ->required(),
                DatePicker::make('reference')
                    ->label('Referência')
                    ->required(),
                TextInput::make('total_fixed')
                    ->label('Total fixo')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_variable')
                    ->label('Total variável')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_reserve')
                    ->label('Total reserva')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_emergency')
                    ->label('Total emergência')
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
