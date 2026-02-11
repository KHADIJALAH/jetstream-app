<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            HotelSeeder::class,
            ActivitySeeder::class,
            RestaurantSeeder::class,
            FlightSeeder::class,
            VacationRentalSeeder::class,
            CruiseSeeder::class,
            RentalCarSeeder::class,
            ForumTopicSeeder::class,
            ForumPostSeeder::class,
            ReservationSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}