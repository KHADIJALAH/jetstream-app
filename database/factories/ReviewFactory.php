<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'reviewable_type' => $this->faker->randomElement([
                \App\Models\Hotel::class,
                \App\Models\Restaurant::class,
                \App\Models\Activity::class
            ]),
            'reviewable_id' => $this->faker->numberBetween(1, 100),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->sentence(),
        ];
    }
}