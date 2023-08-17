<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Habitation>
 */
class HabitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'city' => fake()->city(),
            'type' => 'House',
            'price' => random_int(100, 200),
            'bedrooms' => rand(1,5),
            'garages' => rand(1,5),
            'bathrooms' => rand(1,5)
        ];
    }
}
