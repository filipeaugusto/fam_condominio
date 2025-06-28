<?php

namespace App\Filament\Resources\CondominiumResource\Pages;

use App\Filament\Resources\CondominiumResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCondominia extends ListRecords
{
    protected static string $resource = CondominiumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
