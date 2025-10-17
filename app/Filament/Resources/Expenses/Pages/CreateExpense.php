<?php

namespace App\Filament\Resources\Expenses\Pages;

use App\Filament\Resources\Expenses\ExpenseResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Resources\Pages\CreateRecord;

class CreateExpense extends CreateRecord
{
    use RedirectsAfterSave;

    protected static string $resource = ExpenseResource::class;
}
