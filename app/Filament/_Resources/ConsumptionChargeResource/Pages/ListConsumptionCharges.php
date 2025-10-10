<?php

namespace App\Filament\_Resources\ConsumptionChargeResource\Pages;

use App\Filament\_Resources\ConsumptionChargeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConsumptionCharges extends ListRecords
{
    protected static string $resource = ConsumptionChargeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
