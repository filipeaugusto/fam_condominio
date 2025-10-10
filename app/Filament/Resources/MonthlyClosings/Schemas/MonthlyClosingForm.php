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
                    ->required(),
                DatePicker::make('reference')
                    ->required(),
                TextInput::make('total_fixed')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_variable')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_reserve')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_emergency')
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric()
                    ->default(0.0),
            ]);
    }
}
