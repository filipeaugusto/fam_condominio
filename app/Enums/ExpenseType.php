<?php

namespace App\Enums;

use BackedEnum;
use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;

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
            self::FIXED => Color::Cyan,
            self::VARIABLE => Color::Yellow,
            self::RESERVE => Color::Green,
            self::EMERGENCY => Color::Red,
        };
    }

    public function getIcon(): string|null|BackedEnum
    {
        return match ($this) {
            self::FIXED => Heroicon::ArrowPath,
            self::VARIABLE => Heroicon::InformationCircle,
            self::RESERVE => Heroicon::Banknotes,
            self::EMERGENCY => Heroicon::ExclamationTriangle,
        };
    }

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::FIXED => 'Recorrente',
            self::VARIABLE => 'Variável',
            self::RESERVE => 'Reserva',
            self::EMERGENCY => 'Emergêncial'
        };
    }
}
