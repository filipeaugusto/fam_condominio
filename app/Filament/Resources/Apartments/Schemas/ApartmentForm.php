<?php

namespace App\Filament\Resources\Apartments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ApartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('condominium_id')
                    ->relationship('condominium', 'name')
                    ->required(),
                TextInput::make('identifier')
                    ->required(),
                TextInput::make('fraction')
                    ->required()
                    ->numeric()
                    ->default(0.0),
            ]);
    }
}
