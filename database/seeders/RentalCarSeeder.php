<?php

namespace Database\Seeders;

use App\Models\RentalCar;
use Illuminate\Database\Seeder;

class RentalCarSeeder extends Seeder
{
    public function run(): void
    {
        RentalCar::factory(50)
            ->hasReservations(3)
            ->create();
    }
}