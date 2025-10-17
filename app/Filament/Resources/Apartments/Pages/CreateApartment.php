<?php

namespace App\Filament\Resources\Apartments\Pages;

use App\Filament\Resources\Apartments\ApartmentResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Resources\Pages\CreateRecord;

class CreateApartment extends CreateRecord
{
    use RedirectsAfterSave;

    protected static string $resource = ApartmentResource::class;
}
