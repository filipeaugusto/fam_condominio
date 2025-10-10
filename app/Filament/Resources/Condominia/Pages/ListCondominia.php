<?php

namespace App\Filament\Resources\Condominia\Pages;

use App\Filament\Resources\Condominia\CondominiumResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCondominia extends ListRecords
{
    protected static string $resource = CondominiumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
