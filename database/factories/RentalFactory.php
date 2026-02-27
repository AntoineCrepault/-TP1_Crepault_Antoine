<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_date'   => fake()->date(),
            'end_date'     => fake()->date(),
            'total_price'  => fake()->randomFloat(2, 5, 200),
            'equipment_id' => fake()->numberBetween(1,5), //temp solution
        ];
    }
}
