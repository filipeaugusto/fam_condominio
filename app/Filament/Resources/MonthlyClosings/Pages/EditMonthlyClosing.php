<?php

namespace App\Filament\Resources\MonthlyClosings\Pages;

use App\Filament\Resources\MonthlyClosings\MonthlyClosingResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditMonthlyClosing extends EditRecord
{
    use RedirectsAfterSave;

    protected static string $resource = MonthlyClosingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
