<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->catchPhrase(),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->address(),
            'price' => $this->faker->randomFloat(2, 10, 200),
            'duration' => $this->faker->time(),
        ];
    }
}