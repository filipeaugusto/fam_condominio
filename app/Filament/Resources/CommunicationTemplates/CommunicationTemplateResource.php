<?php

namespace App\Filament\Resources\CommunicationTemplates;

use App\Filament\Resources\CommunicationTemplates\Pages\CreateCommunicationTemplate;
use App\Filament\Resources\CommunicationTemplates\Pages\EditCommunicationTemplate;
use App\Filament\Resources\CommunicationTemplates\Pages\ListCommunicationTemplates;
use App\Filament\Resources\CommunicationTemplates\Pages\ViewCommunicationTemplate;
use App\Filament\Resources\CommunicationTemplates\Schemas\CommunicationTemplateForm;
use App\Filament\Resources\CommunicationTemplates\Schemas\CommunicationTemplateInfolist;
use App\Filament\Resources\CommunicationTemplates\Tables\CommunicationTemplatesTable;
use App\Models\CommunicationTemplate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CommunicationTemplateResource extends Resource
{
    protected static ?string $model = CommunicationTemplate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::EnvelopeOpen;

    protected static ?string $recordTitleAttribute = 'modelo de comunicação';
    protected static ?string $modelLabel = 'modelos de comunicação';
    protected static ?string $pluralModelLabel = 'modelos de comunicação';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Gerenciar modelos';
    protected static string|null|\UnitEnum $navigationGroup = 'Comunicações';


    public static function form(Schema $schema): Schema
    {
        return CommunicationTemplateForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CommunicationTemplateInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommunicationTemplatesTable::configure($table);
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
            'index' => ListCommunicationTemplates::route('/'),
            'create' => CreateCommunicationTemplate::route('/create'),
            'edit' => EditCommunicationTemplate::route('/{record}/edit'),
        ];
    }
}
