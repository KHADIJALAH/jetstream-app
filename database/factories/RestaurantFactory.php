<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->company(),
            'cuisine_type' => $this->faker->randomElement(['Italian', 'French', 'Japanese', 'Mexican', 'American']),
            'description' => $this->faker->paragraph(),
            'price_range' => str_repeat('$', $this->faker->numberBetween(1, 4)),
            'opening_hours' => $this->faker->time('H:i A') . ' - ' . $this->faker->time('H:i A'),
        ];
    }
}