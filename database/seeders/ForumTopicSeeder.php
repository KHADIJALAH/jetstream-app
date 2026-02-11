<?php

namespace Database\Seeders;

use App\Models\ForumTopic;
use Illuminate\Database\Seeder;

class ForumTopicSeeder extends Seeder
{
    public function run(): void
    {
        ForumTopic::factory(25)
            ->hasPosts(5)
            ->create();
    }
}