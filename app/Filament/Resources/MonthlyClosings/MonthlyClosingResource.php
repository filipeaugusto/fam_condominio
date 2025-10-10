<?php

namespace App\Filament\Resources\MonthlyClosings;

use App\Filament\Resources\MonthlyClosings\Pages\CreateMonthlyClosing;
use App\Filament\Resources\MonthlyClosings\Pages\EditMonthlyClosing;
use App\Filament\Resources\MonthlyClosings\Pages\ListMonthlyClosings;
use App\Filament\Resources\MonthlyClosings\Schemas\MonthlyClosingForm;
use App\Filament\Resources\MonthlyClosings\Tables\MonthlyClosingsTable;
use App\Models\MonthlyClosing;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MonthlyClosingResource extends Resource
{
    protected static ?string $model = MonthlyClosing::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'MonthlyClosing';

    public static function form(Schema $schema): Schema
    {
        return MonthlyClosingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MonthlyClosingsTable::configure($table);
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
            'index' => ListMonthlyClosings::route('/'),
            'create' => CreateMonthlyClosing::route('/create'),
            'edit' => EditMonthlyClosing::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
