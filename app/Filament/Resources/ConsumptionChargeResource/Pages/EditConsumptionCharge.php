<?php

namespace App\Filament\Resources\ConsumptionChargeResource\Pages;

use App\Filament\Resources\ConsumptionChargeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConsumptionCharge extends EditRecord
{
    protected static string $resource = ConsumptionChargeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
