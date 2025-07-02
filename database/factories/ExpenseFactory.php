<?php

namespace Database\Factories;

use App\Models\Condominium;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'condominium_id' => Condominium::factory(),
            'type' => $this->faker->randomElement(['fixed', 'variable', 'reserve']),
            'label' => $this->faker->words(2, true),
            'amount' => $this->faker->randomFloat(2, 50, 500),
            'due_date' => now()->addDays(rand(1, 30)),
            'included_in_closing' => false,
        ];
    }
}
