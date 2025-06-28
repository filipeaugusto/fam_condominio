<?php

namespace App\Filament\Resources;

use App\Enums\ExpenseService;
use App\Enums\ExpenseType;
use App\Filament\Resources\ExpenseResource\Pages;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'despesa';
    protected static ?string $pluralLabel = 'despesas';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('condominium_id')
                    ->label('Condomínio')
                    ->relationship('condominium', 'name')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->label('Tipo')
                    ->options(Expense::getTypes())
                    ->live()
                    ->afterStateUpdated(function (Forms\Set $set) {
                        $set('service_class', ExpenseService::not_apply->value);
                    })
                    ->required(),
                Forms\Components\Select::make('service_class')
                    ->label('Classe de serviço')
                    ->options(Expense::getServices())
                    ->default(ExpenseService::not_apply->value)
                    ->disabled(fn (callable $get) => $get('type') !== ExpenseType::variable->value)
                    ->required(fn (callable $get) => $get('type') === ExpenseType::variable->value)
                    ->required(),
                Forms\Components\TextInput::make('label')
                    ->label('Nome')
                    ->placeholder('Ex: Conta de luz mes/ano')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount')
                    ->label('Valor')
                    ->minValue(0.01)
                    ->default(0)
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('due_date')
                    ->label('Data de vencimento')
                    ->required(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('condominium.name')
                    ->label('Condomínio')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo'),
                Tables\Columns\TextColumn::make('label')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Valor')
                    ->numeric()
                    ->money("BRL")
                    ->sortable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Data de vencimento')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('included_in_closing')
                    ->label('Incluído no fechamento')
                    ->boolean(),
                Tables\Columns\TextColumn::make('monthlyClosing.id')
                    ->label('Fechamento mensal')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}
