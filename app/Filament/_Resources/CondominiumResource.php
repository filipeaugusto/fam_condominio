<?php

namespace App\Filament\_Resources;

use App\Filament\_Resources\CondominiumResource\Pages;
use App\Models\Condominium;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CondominiumResource extends Resource
{
    protected static ?string $model = Condominium::class;
    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'condomínio';
    protected static ?string $pluralLabel = 'condomínios';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getSlug(): string
    {
        return 'condominium'; // ou 'condominiums' se preferir no plural
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('document')
                    ->label('CNPJ')
                    ->mask('999.999.999/9999-99'),
                Forms\Components\FileUpload::make('logo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListCondominia::route('/'),
            'create' => Pages\CreateCondominium::route('/create'),
            'edit' => Pages\EditCondominium::route('/{record}/edit'),
        ];
    }
}
