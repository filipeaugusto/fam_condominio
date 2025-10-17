<?php

namespace App\Filament\Resources\ConsumptionCharges\Pages;

use App\Filament\Resources\ConsumptionCharges\ConsumptionChargeResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Resources\Pages\CreateRecord;

class CreateConsumptionCharge extends CreateRecord
{
    use RedirectsAfterSave;

    protected static string $resource = ConsumptionChargeResource::class;
}
