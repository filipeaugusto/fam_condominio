<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ExpenseType: string implements HasIcon, HasLabel, HasColor
{
    case fixed = 'fixed';
    case variable = 'variable';
    case reserve = 'reserve';

    case emergency = 'emergency';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::fixed => 'success',
            self::variable => 'warning',
            self::reserve => 'info',
            self::emergency => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::fixed => 'heroicon-m-arrow-path',
            self::variable => 'heroicon-m-arrow-path',
            self::reserve => 'heroicon-m-arrow-path',
            self::emergency => 'heroicon-m-arrow-path',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::fixed => 'Fixa',
            self::variable => 'Variável',
            self::reserve => 'Reserva',
            self::emergency => 'Emergêncial'
        };
    }
}
