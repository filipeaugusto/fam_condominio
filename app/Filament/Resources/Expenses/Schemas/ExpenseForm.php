<?php

namespace App\Filament\Resources\Expenses\Schemas;

use App\Enums\ExpenseService;
use App\Enums\ExpenseType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('condominium_id')
                    ->label('Condomínio')
                    ->relationship('condominium', 'name')
                    ->required(),
                Select::make('type')
                    ->label('Tipo')
                    ->options(ExpenseType::class)
                    ->default('fixed')
                    ->required(),
                Select::make('service_class')
                    ->label('Classe de serviço')
                    ->options(ExpenseService::class)
                    ->default('not_apply')
                    ->required(),
                TextInput::make('label')
                    ->label('Nome')
                    ->required(),
                TextInput::make('amount')
                    ->label('Valor')
                    ->required()
                    ->numeric(),
                DatePicker::make('due_date')
                    ->label('Data de vencimento')
                    ->required(),
                Toggle::make('included_in_closing')
                    ->label('Incluir no fechamento mensal')
                    ->required(),
                Select::make('monthly_closing_id')
                    ->label('Fechamento mensal')
                    ->relationship('monthlyClosing', 'reference'),
            ]);
    }
}
