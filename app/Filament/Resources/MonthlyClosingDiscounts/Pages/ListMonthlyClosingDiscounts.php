<?php

namespace App\Filament\Resources\MonthlyClosingDiscounts\Pages;

use App\Filament\Resources\MonthlyClosingDiscounts\MonthlyClosingDiscountResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMonthlyClosingDiscounts extends ListRecords
{
    protected static string $resource = MonthlyClosingDiscountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
