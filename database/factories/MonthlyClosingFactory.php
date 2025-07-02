<?php

namespace Database\Factories;

use App\Models\Condominium;
use App\Models\MonthlyClosing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MonthlyClosing>
 */
class MonthlyClosingFactory extends Factory
{
    protected $model = MonthlyClosing::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'condominium_id' => Condominium::factory(),
            'reference' => now()->startOfMonth(),
            'total_fixed_expenses' => 0,
            'total_variable_expenses' => 0,
            'total_reserve' => 0,
            'total_amount' => 0,
        ];
    }
}
