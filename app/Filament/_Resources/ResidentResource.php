<?php

namespace App\Filament\_Resources;

use App\Filament\_Resources\ResidentResource\Pages;
use App\Models\Resident;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ResidentResource extends Resource
{
    protected static ?string $model = Resident::class;
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'residente';
    protected static ?string $pluralLabel = 'residentes';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Nome')
                    ->required(),
                Forms\Components\Select::make('apartment_id')
                    ->relationship('apartment', 'identifier')
                    ->label('Apartamento')
                    ->required(),
                Forms\Components\Toggle::make('is_responsible')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nome')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('apartment.identifier')
                    ->label('Apartamento')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_responsible')
                    ->label('Responsável')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageResidents::route('/'),
        ];
    }
}
