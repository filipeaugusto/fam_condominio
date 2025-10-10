<?php

namespace App\Filament\_Resources\ResidentResource\Pages;

use App\Filament\_Resources\ResidentResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageResidents extends ManageRecords
{
    protected static string $resource = ResidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
