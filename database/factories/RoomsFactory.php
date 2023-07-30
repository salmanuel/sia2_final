<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rooms>
 */
class RoomsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bed_type' => $this->faker->randomElement(['Single', 'Double', 'King']),
            'rate' => $this->faker->randomFloat(2, 50, 200), // Generates a random float between 50 and 200
            'rooms_available' => $this->faker->numberBetween(0, 10),
        ];
    }
}
