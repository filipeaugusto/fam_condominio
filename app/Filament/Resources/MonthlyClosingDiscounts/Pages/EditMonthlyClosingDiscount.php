<?php

namespace App\Filament\Resources\MonthlyClosingDiscounts\Pages;

use App\Filament\Resources\MonthlyClosingDiscounts\MonthlyClosingDiscountResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMonthlyClosingDiscount extends EditRecord
{
    use RedirectsAfterSave;

    protected static string $resource = MonthlyClosingDiscountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
