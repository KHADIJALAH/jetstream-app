<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        Restaurant::factory(40)
            ->hasReservations(5)
            ->hasReviews(8)
            ->create();
    }
}