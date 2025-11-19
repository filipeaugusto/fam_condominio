<?php

namespace App\Filament\Resources\MonthlyClosingApartments;

use App\Filament\Resources\MonthlyClosingApartments\Pages\ListMonthlyClosingApartments;
use App\Filament\Resources\MonthlyClosingApartments\Schemas\MonthlyClosingApartmentForm;
use App\Filament\Resources\MonthlyClosingApartments\Tables\MonthlyClosingApartmentsTable;
use App\Models\MonthlyClosingApartment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MonthlyClosingApartmentResource extends Resource
{
    protected static ?string $model = MonthlyClosingApartment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Fechamento mensal por apartamento';
    protected static ?string $modelLabel = 'Fechamento mensal por apartamento';
    protected static ?string $pluralModelLabel = 'Fechamentos mensais';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Gerenciar fechamentos por apartamento';
    protected static string|null|\UnitEnum $navigationGroup = 'Financeiro';

    public static function form(Schema $schema): Schema
    {
        return MonthlyClosingApartmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MonthlyClosingApartmentsTable::configure($table);
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
            'index' => ListMonthlyClosingApartments::route('/'),
        ];
    }
}
