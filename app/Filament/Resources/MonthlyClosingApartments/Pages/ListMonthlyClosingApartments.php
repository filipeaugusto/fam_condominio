<?php

namespace App\Filament\Resources\MonthlyClosingApartments\Pages;

use App\Filament\Resources\MonthlyClosingApartments\MonthlyClosingApartmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMonthlyClosingApartments extends ListRecords
{
    protected static string $resource = MonthlyClosingApartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
