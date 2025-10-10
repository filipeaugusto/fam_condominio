<?php

namespace App\Filament\Resources\Residents;

use App\Filament\Resources\Residents\Pages\CreateResident;
use App\Filament\Resources\Residents\Pages\EditResident;
use App\Filament\Resources\Residents\Pages\ListResidents;
use App\Filament\Resources\Residents\Schemas\ResidentForm;
use App\Filament\Resources\Residents\Tables\ResidentsTable;
use App\Models\Resident;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ResidentResource extends Resource
{
    protected static ?string $model = Resident::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Resident';

    public static function form(Schema $schema): Schema
    {
        return ResidentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResidentsTable::configure($table);
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
            'index' => ListResidents::route('/'),
            'create' => CreateResident::route('/create'),
            'edit' => EditResident::route('/{record}/edit'),
        ];
    }
}
