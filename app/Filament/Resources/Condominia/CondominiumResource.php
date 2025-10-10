<?php

namespace App\Filament\Resources\Condominia;

use App\Filament\Resources\Condominia\Pages\CreateCondominium;
use App\Filament\Resources\Condominia\Pages\EditCondominium;
use App\Filament\Resources\Condominia\Pages\ListCondominia;
use App\Filament\Resources\Condominia\Schemas\CondominiumForm;
use App\Filament\Resources\Condominia\Tables\CondominiaTable;
use App\Models\Condominium;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CondominiumResource extends Resource
{
    protected static ?string $model = Condominium::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice2;

    protected static ?string $recordTitleAttribute = 'Condomínio';
    protected static ?string $modelLabel = 'Condomínio';
    protected static ?string $pluralModelLabel = 'Condomínios';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return CondominiumForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CondominiaTable::configure($table);
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
            'index' => ListCondominia::route('/'),
            'create' => CreateCondominium::route('/create'),
            'edit' => EditCondominium::route('/{record}/edit'),
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
