<?php
namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::factory(50)
            ->hasReservations(2)
            ->hasReviews(3)
            ->create();
    }
}