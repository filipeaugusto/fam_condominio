<?php

namespace App\Filament\Resources\Condominia\Pages;

use App\Filament\Resources\Condominia\CondominiumResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditCondominium extends EditRecord
{
    use RedirectsAfterSave;

    protected static string $resource = CondominiumResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
