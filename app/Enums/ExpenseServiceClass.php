<?php

namespace App\Enums;

use Exception;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ExpenseServiceClass: string implements HasIcon, HasLabel, HasColor
{
    const water = 'water';
    const light = 'light';
    const cooking_gas = 'cooking_gas';
    const not_apply = 'not_apply';

    /**
     * @return string|null
     * @throws Exception
     */
    public function getIcon(): ?string
    {
        return match ($this) {
            self::water => 'heroicon-m-arrow-path',
            self::light => 'heroicon-m-arrow-path',
            self::cooking_gas => 'heroicon-m-arrow-path',
            self::not_apply => 'heroicon-m-arrow-path',
            default => throw new Exception('Unexpected match value'),
        };
    }

    /**
     * @throws Exception
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::water => 'Água',
            self::light => 'Luz',
            self::cooking_gas => 'Gás',
            self::not_apply => 'Não se aplica',
            default => throw new Exception('Unexpected match value'),
        };
    }

    /**
     * @throws Exception
     */
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::water => 'success',
            self::light => 'light',
            self::cooking_gas => 'warning',
            self::not_apply => 'light',
            default => throw new Exception('Unexpected match value'),
        };
    }
}
