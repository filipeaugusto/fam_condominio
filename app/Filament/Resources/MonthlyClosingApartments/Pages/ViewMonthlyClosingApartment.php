<?php

namespace App\Filament\Resources\MonthlyClosingApartments\Pages;

use App\Filament\Resources\MonthlyClosingApartments\MonthlyClosingApartmentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMonthlyClosingApartment extends ViewRecord
{
    protected static string $resource = MonthlyClosingApartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
