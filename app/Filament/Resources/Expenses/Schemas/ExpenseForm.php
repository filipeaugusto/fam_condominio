<?php

namespace App\Filament\Resources\Expenses\Schemas;

use App\Enums\ExpenseService;
use App\Enums\ExpenseType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
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
                    ->numeric()
                    ->prefix('R$')
                    ->default(0)
                    ->rules(['numeric', 'min:0']),
                DatePicker::make('due_date')
                    ->label('Data de vencimento')
                    ->required(),
                Toggle::make('included_in_closing')
                    ->label('Incluir no fechamento mensal')
                    ->required(),
                Select::make('monthly_closing_id')
                    ->label('Fechamento mensal')
                    ->relationship('monthlyClosing', 'reference'),
                Toggle::make('is_paid')
                    ->label('Pago')
                    ->inline(false)
                    ->onColor('success')
                    ->offColor('danger')
                    ->afterStateUpdated(function (Set $set, $state) {
                        if ($state) {
                            $set('paid_at', now());
                        } else {
                            $set('paid_at', null);
                        }
                    }),
                DateTimePicker::make('paid_at')
                    ->label('Data do Pagamento')
                    ->displayFormat('d/m/Y H:i')
                    ->seconds(false)
                    ->nullable()
                    ->readOnly(),
            ]);
    }
}
