<?php

namespace Database\Factories;

use App\Models\Apartment;
use App\Models\Condominium;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    protected $model = Apartment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'identifier' => 'Apto ' . $this->faker->numberBetween(101, 150),
            'condominium_id' => Condominium::factory(),
            'fraction' => 1.0,
        ];
    }
}
