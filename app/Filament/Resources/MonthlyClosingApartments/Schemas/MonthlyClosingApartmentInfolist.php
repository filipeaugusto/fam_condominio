<?php

namespace App\Filament\Resources\MonthlyClosingApartments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MonthlyClosingApartmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('monthlyClosing.id')
                    ->label('Monthly closing'),
                TextEntry::make('apartment.id')
                    ->label('Apartment'),
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
