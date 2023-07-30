<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    protected $model = Booking::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id' => function () {
                return \App\Models\Rooms::inRandomOrder()->first()->id;
            },
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'arrival_date' => $this->faker->date(),
            'departure_date' => $this->faker->date(),
            'num_adults' => $this->faker->numberBetween(19, 99), // Generates a random number between 19 and 99
            'num_kids' => $this->faker->numberBetween(0, 18), // Generates a random number between 0 and 18
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
