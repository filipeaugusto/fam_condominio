<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ExpenseType: string implements HasIcon, HasLabel, HasColor
{
    case FIXED = 'fixed';
    case VARIABLE = 'variable';
    case RESERVE = 'reserve';

    case EMERGENCY = 'emergency';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::FIXED => 'success',
            self::VARIABLE => 'warning',
            self::RESERVE => 'info',
            self::EMERGENCY => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::FIXED => 'heroicon-m-arrow-path',
            self::VARIABLE => 'heroicon-m-arrow-path',
            self::RESERVE => 'heroicon-m-arrow-path',
            self::EMERGENCY => 'heroicon-m-arrow-path',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::FIXED => 'Fixa',
            self::VARIABLE => 'Variável',
            self::RESERVE => 'Reserva',
            self::EMERGENCY => 'Emergêncial'
        };
    }
}
