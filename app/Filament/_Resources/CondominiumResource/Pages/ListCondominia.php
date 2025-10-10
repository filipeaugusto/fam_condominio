<?php

namespace App\Filament\_Resources\CondominiumResource\Pages;

use App\Filament\_Resources\CondominiumResource;
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
