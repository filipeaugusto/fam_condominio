<?php

namespace App\Filament\Resources\MonthlyClosingApartments\Pages;

use App\Filament\Resources\MonthlyClosingApartments\MonthlyClosingApartmentResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMonthlyClosingApartment extends EditRecord
{
    use RedirectsAfterSave;

    protected static string $resource = MonthlyClosingApartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
