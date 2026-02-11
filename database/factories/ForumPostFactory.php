<?php

namespace Database\Factories;

use App\Models\ForumPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumPostFactory extends Factory
{
    protected $model = ForumPost::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'forum_topic_id' => \App\Models\ForumTopic::factory(),
            'content' => $this->faker->paragraph(),
        ];
    }
}