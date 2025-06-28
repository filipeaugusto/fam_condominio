<?php

namespace App\Enums;

use Exception;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ExpenseService: string implements HasIcon, HasLabel, HasColor
{
    case water = 'water';
    case light = 'light';
    case cooking_gas = 'cooking_gas';
    case not_apply = 'not_apply';

    public function getIcon(): ?string
    {
        return match ($this) {
            self::water => 'heroicon-m-arrow-path',
            self::light => 'heroicon-m-arrow-path',
            self::cooking_gas => 'heroicon-m-arrow-path',
            self::not_apply => 'heroicon-m-arrow-path',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::water => 'Água',
            self::light => 'Luz',
            self::cooking_gas => 'Gás',
            self::not_apply => 'Não se aplica',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::water => 'success',
            self::light => 'light',
            self::cooking_gas => 'warning',
            self::not_apply => 'light',
        };
    }
}
