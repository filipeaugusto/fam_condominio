<?php

namespace App\Filament\Resources\ConsumptionCharges;

use App\Filament\Resources\ConsumptionCharges\Pages\CreateConsumptionCharge;
use App\Filament\Resources\ConsumptionCharges\Pages\EditConsumptionCharge;
use App\Filament\Resources\ConsumptionCharges\Pages\ListConsumptionCharges;
use App\Filament\Resources\ConsumptionCharges\Schemas\ConsumptionChargeForm;
use App\Filament\Resources\ConsumptionCharges\Tables\ConsumptionChargesTable;
use App\Models\ConsumptionCharge;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsumptionChargeResource extends Resource
{
    protected static ?string $model = ConsumptionCharge::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ConsumptionCharge';

    public static function form(Schema $schema): Schema
    {
        return ConsumptionChargeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConsumptionChargesTable::configure($table);
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
            'index' => ListConsumptionCharges::route('/'),
            'create' => CreateConsumptionCharge::route('/create'),
            'edit' => EditConsumptionCharge::route('/{record}/edit'),
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
