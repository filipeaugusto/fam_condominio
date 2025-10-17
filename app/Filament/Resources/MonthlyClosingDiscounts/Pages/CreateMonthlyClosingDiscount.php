<?php

namespace App\Filament\Resources\MonthlyClosingDiscounts\Pages;

use App\Filament\Resources\MonthlyClosingDiscounts\MonthlyClosingDiscountResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Resources\Pages\CreateRecord;

class CreateMonthlyClosingDiscount extends CreateRecord
{
    use RedirectsAfterSave;

    protected static string $resource = MonthlyClosingDiscountResource::class;
}
