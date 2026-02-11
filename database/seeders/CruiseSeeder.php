<?php

namespace Database\Seeders;

use App\Models\Cruise;
use Illuminate\Database\Seeder;

class CruiseSeeder extends Seeder
{
    public function run(): void
    {
        Cruise::factory(30)
            ->hasReservations(2)
            ->hasReviews(4)
            ->create();
    }
}