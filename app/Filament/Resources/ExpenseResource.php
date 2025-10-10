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
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'despesa';
    protected static ?string $pluralLabel = 'despesas';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Financeiro';


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
                        $set('service_class', ExpenseService::NOT_APPLY->value);
                    })
                    ->required(),
                Forms\Components\Select::make('service_class')
                    ->label('Classe de serviço')
                    ->options(Expense::getServices())
                    ->default(ExpenseService::NOT_APPLY->value)
                    ->disabled(fn (callable $get) => $get('type') !== ExpenseType::VARIABLE->value)
                    ->required(fn (callable $get) => $get('type') === ExpenseType::VARIABLE->value)
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
                    ->summarize(Sum::make())
                    ->sortable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->label('Data de vencimento')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label('Status')
                    ->colors([
                        'danger' => 'Vencida',
                        'warning' => 'A vencer',
                        'success' => 'Paga',
                    ])
                    ->icons([
                        'heroicon-o-x-circle' => 'Vencida',
                        'heroicon-o-clock' => 'A vencer',
                        'heroicon-o-check-circle' => 'Paga',
                    ])
                    // se quiser permitir ordenação por "status" (virtual), implemente uma query custom:
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        // mapear status para ordem: Paga(1), Vencida(2), A vencer(3)
                        $today = Carbon::today()->toDateString();
                        return $query->orderByRaw("
                            CASE
                                WHEN included_in_closing = 1 THEN 1
                                WHEN due_date < ? THEN 2
                                ELSE 3
                            END {$direction}
                        ", [$today]);
                    })
                    // e se quiser permitir busca por texto (sobre o status), implemente query custom de search
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where(function (Builder $q) use ($search) {
                            $q->whereRaw("CASE WHEN included_in_closing = 1 THEN 'Paga' WHEN due_date < ? THEN 'Vencida' ELSE 'A vencer' END LIKE ?", [
                                Carbon::today()->toDateString(),
                                "%{$search}%"
                            ]);
                        });
                    }),
                Tables\Columns\IconColumn::make('included_in_closing')
                    ->label('Incluído no fechamento')
                    ->boolean(),
                Tables\Columns\TextColumn::make('monthlyClosing.reference')
                    ->label('Fechamento mensal')
                    ->date('d/m/Y')
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
            ->defaultSort('included_in_closing')
            ->filters([
                Tables\Filters\Filter::make('overdue')
                    ->label('Somente vencidas')
                    ->query(fn (Builder $query): Builder => $query->overdue())
                    ->toggle(),
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
