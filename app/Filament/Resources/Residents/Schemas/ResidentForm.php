<?php

namespace App\Filament\Resources\Residents\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ResidentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Nome')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('apartment_id')
                    ->label('Apartamento')
                    ->relationship('apartment', 'identifier')
                    ->required(),
                Toggle::make('is_responsible')
                    ->label('Responsável')
                    ->required(),
            ]);
    }
}
