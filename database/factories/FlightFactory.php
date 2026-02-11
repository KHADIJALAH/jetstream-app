<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'flight_number' => $this->faker->bothify('??###'),
            'airline' => $this->faker->company(),
            'departure_airport' => $this->faker->airportCode(),
            'arrival_airport' => $this->faker->airportCode(),
            'departure_time' => $this->faker->dateTimeBetween('+1 day', '+1 week'),
            'arrival_time' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'price' => $this->faker->randomFloat(2, 100, 2000),
        ];
    }
}