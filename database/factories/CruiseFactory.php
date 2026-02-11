<?php

namespace Database\Factories;

use App\Models\Cruise;
use Illuminate\Database\Eloquent\Factories\Factory;

class CruiseFactory extends Factory
{
    protected $model = Cruise::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'cruise_line' => $this->faker->company(),
            'itinerary' => $this->faker->sentence(),
            'start_date' => $this->faker->dateBetween('+1 week', '+1 month'),
            'end_date' => $this->faker->dateBetween('+2 months', '+3 months'),
            'price' => $this->faker->randomFloat(2, 1000, 10000),
        ];
    }
}