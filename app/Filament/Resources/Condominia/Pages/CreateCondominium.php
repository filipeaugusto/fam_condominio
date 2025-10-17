<?php

namespace App\Filament\Resources\Condominia\Pages;

use App\Filament\Resources\Condominia\CondominiumResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Resources\Pages\CreateRecord;

class CreateCondominium extends CreateRecord
{
    use RedirectsAfterSave;

    protected static string $resource = CondominiumResource::class;
}
