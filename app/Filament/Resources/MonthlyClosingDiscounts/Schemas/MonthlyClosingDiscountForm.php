<?php

namespace App\Filament\Resources\MonthlyClosingDiscounts\Schemas;

use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MonthlyClosingDiscountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('monthly_closing_id')
                    ->visible(fn ($record) => $record->monthly_closing_id ?? false)
                    ->readOnly()
                    ->numeric(),
                Select::make('apartment_id')
                    ->label('Apartmento')
                    ->relationship('apartment', 'identifier')
                    ->required(),
                TextInput::make('amount')
                    ->label('Valor do Desconto (R$)')
                    ->required()
                    ->numeric()
                    ->prefix('R$')
                    ->default(0)
                    ->rules(['numeric', 'min:0']),
                MarkdownEditor::make('reason')
                    ->columnSpanFull()
                    ->label('Motivo de Desconto'),
                Toggle::make('applied')
                    ->label('Aplicado?')
                    ->required(),
                DateTimePicker::make('applied_at')
                    ->label('Data de Aplicação'),
                TextInput::make('created_by')
                    ->label('Criado por')
                    ->visible(fn ($record) => $record->created_by ?? false)
                    ->readOnly()
                    ->numeric(),
            ]);
    }
}
