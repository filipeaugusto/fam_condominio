<?php

namespace App\Filament\Resources\MonthlyClosings\Schemas;

use App\Models\MonthlyClosing;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MonthlyClosingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('condominium.name')
                    ->label('Condominium'),
                TextEntry::make('reference')
                    ->date(),
                TextEntry::make('total_fixed')
                    ->numeric(),
                TextEntry::make('total_variable')
                    ->numeric(),
                TextEntry::make('total_reserve')
                    ->numeric(),
                TextEntry::make('total_emergency')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('total_amount')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (MonthlyClosing $record): bool => $record->trashed()),
            ]);
    }
}
