<?php

namespace Database\Factories;

use App\Models\RentalCar;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalCarFactory extends Factory
{
    protected $model = RentalCar::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'car_model' => $this->faker->vehicle(),
            'car_type' => $this->faker->randomElement(['Sedan', 'SUV', 'Truck', 'Van']),
            'daily_price' => $this->faker->randomFloat(2, 30, 200),
            'available_from' => $this->faker->date(),
            'available_to' => $this->faker->date(),
        ];
    }
}