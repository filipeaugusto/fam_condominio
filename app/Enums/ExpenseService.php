<?php

namespace App\Enums;

use Exception;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ExpenseService: string implements HasIcon, HasLabel, HasColor
{
    case WATER = 'water';
    case LIGHT = 'light';
    case COOKING_GAS = 'cooking_gas';
    case NOT_APPLY = 'not_apply';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::WATER => 'heroicon-m-arrow-path',
            self::LIGHT => 'heroicon-m-arrow-path',
            self::COOKING_GAS => 'heroicon-m-arrow-path',
            self::NOT_APPLY => 'heroicon-m-arrow-path',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::WATER => 'Água',
            self::LIGHT => 'Luz',
            self::COOKING_GAS => 'Gás',
            self::NOT_APPLY => 'Não se aplica',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::WATER => 'success',
            self::LIGHT, self::NOT_APPLY => 'light',
            self::COOKING_GAS => 'warning',
        };
    }
}
