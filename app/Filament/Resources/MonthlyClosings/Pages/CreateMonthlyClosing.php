<?php

namespace App\Filament\Resources\MonthlyClosings\Pages;

use App\Filament\Resources\MonthlyClosings\MonthlyClosingResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Resources\Pages\CreateRecord;

class CreateMonthlyClosing extends CreateRecord
{
    use RedirectsAfterSave;

    protected static string $resource = MonthlyClosingResource::class;
}
