<?php

namespace App\Filament\_Resources\MonthlyClosingResource\Pages;

use App\Filament\_Resources\MonthlyClosingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonthlyClosings extends ListRecords
{
    protected static string $resource = MonthlyClosingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
