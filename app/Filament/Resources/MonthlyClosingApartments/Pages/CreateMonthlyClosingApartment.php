<?php

namespace App\Filament\Resources\MonthlyClosingApartments\Pages;

use App\Filament\Resources\MonthlyClosingApartments\MonthlyClosingApartmentResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Resources\Pages\CreateRecord;

class CreateMonthlyClosingApartment extends CreateRecord
{
    use RedirectsAfterSave;

    protected static string $resource = MonthlyClosingApartmentResource::class;
}
