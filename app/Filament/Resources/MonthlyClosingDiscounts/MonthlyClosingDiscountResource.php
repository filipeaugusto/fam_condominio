<?php

namespace App\Filament\Resources\MonthlyClosingDiscounts;

use App\Filament\Resources\MonthlyClosingDiscounts\Pages\CreateMonthlyClosingDiscount;
use App\Filament\Resources\MonthlyClosingDiscounts\Pages\EditMonthlyClosingDiscount;
use App\Filament\Resources\MonthlyClosingDiscounts\Pages\ListMonthlyClosingDiscounts;
use App\Filament\Resources\MonthlyClosingDiscounts\Schemas\MonthlyClosingDiscountForm;
use App\Filament\Resources\MonthlyClosingDiscounts\Tables\MonthlyClosingDiscountsTable;
use App\Models\MonthlyClosingDiscount;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MonthlyClosingDiscountResource extends Resource
{
    protected static ?string $model = MonthlyClosingDiscount::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'descontos por apartamento';
    protected static ?string $modelLabel = 'descontos por apartamento';
    protected static ?string $pluralModelLabel = 'descontos';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Gerenciar descontos';
    protected static string|null|\UnitEnum $navigationGroup = 'Financeiro';

    public static function form(Schema $schema): Schema
    {
        return MonthlyClosingDiscountForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MonthlyClosingDiscountsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMonthlyClosingDiscounts::route('/'),
            'create' => CreateMonthlyClosingDiscount::route('/create'),
            'edit' => EditMonthlyClosingDiscount::route('/{record}/edit'),
        ];
    }
}
