<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('condominium_id')
                    ->label('Condomínio')
                    ->relationship('condominium', 'name'),
                TextInput::make('name')
                    ->label('Nome')
                    ->required(),
                TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at')
                    ->label('E-mail Verificado'),
                TextInput::make('password')
                    ->label('Senha')
                    ->password()
                    ->required(),
            ]);
    }
}
