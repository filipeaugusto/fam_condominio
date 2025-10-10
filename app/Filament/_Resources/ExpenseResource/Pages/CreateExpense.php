<?php

namespace App\Filament\_Resources\ExpenseResource\Pages;

use App\Filament\_Resources\ExpenseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExpense extends CreateRecord
{
    protected static string $resource = ExpenseResource::class;
}
