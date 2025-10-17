<?php

namespace App\Filament\Resources\Residents\Pages;

use App\Filament\Resources\Residents\ResidentResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResident extends EditRecord
{
    use RedirectsAfterSave;

    protected static string $resource = ResidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
