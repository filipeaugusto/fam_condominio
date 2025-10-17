<?php

namespace App\Filament\Resources\Residents\Pages;

use App\Filament\Resources\Residents\ResidentResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Resources\Pages\CreateRecord;

class CreateResident extends CreateRecord
{
    use RedirectsAfterSave;

    protected static string $resource = ResidentResource::class;
}
