<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Activity;
use App\Models\Booking;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $activities = Activity::all();
        
        foreach($activities as $activity) {
            Booking::factory()->count(rand(3, 15))->create([
                'activity_id' => $activity->id,
                'total_price' => $activity->price * rand(1, 5)
            ]);
        }
    }
}
