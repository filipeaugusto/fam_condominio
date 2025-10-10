<?php

namespace App\Filament\Resources\ConsumptionCharges\Pages;

use App\Filament\Resources\ConsumptionCharges\ConsumptionChargeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConsumptionCharges extends ListRecords
{
    protected static string $resource = ConsumptionChargeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
