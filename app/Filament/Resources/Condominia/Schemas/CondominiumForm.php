<?php

namespace App\Filament\Resources\Condominia\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CondominiumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required(),
                TextInput::make('document')
                    ->label('CNPJ')
                    ->mask('999.999.999/9999-99')
                    ->required(),
                FileUpload::make('logo'),
            ]);
    }
}
