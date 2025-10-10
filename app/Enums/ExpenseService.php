<?php

namespace App\Enums;

use BackedEnum;
use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

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

    public function getIcon(): string|null|BackedEnum
    {
        return match ($this) {
            self::WATER => Heroicon::Cloud,
            self::LIGHT => Heroicon::Bolt,
            self::COOKING_GAS => Heroicon::Fire,
            self::NOT_APPLY => Heroicon::XMark,
        };
    }

    public function getLabel(): string|Htmlable|null
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
            self::WATER => Color::Cyan,
            self::LIGHT => Color::Sky,
            self::COOKING_GAS => Color::Red,
            self::NOT_APPLY => Color::Gray,
        };
    }
}
