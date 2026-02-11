<?php

namespace Database\Factories;

use App\Models\VacationRental;
use Illuminate\Database\Eloquent\Factories\Factory;

class VacationRentalFactory extends Factory
{
    protected $model = VacationRental::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'property_type' => $this->faker->randomElement(['Apartment', 'House', 'Villa', 'Cottage']),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'price_per_night' => $this->faker->randomFloat(2, 80, 800),
            'amenities' => json_encode($this->faker->words(5)),
        ];
    }
}