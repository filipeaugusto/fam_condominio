<?php

namespace App\Filament\Resources\ConsumptionCharges\Pages;

use App\Filament\Resources\ConsumptionCharges\ConsumptionChargeResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditConsumptionCharge extends EditRecord
{
    use RedirectsAfterSave;

    protected static string $resource = ConsumptionChargeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
