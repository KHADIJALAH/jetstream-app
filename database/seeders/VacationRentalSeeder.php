<?php

namespace Database\Seeders;

use App\Models\VacationRental;
use Illuminate\Database\Seeder;

class VacationRentalSeeder extends Seeder
{
    public function run(): void
    {
        VacationRental::factory(60)
            ->hasReservations(4)
            ->hasReviews(6)
            ->create();
    }
}
