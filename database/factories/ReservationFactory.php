<?php
namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'reservable_type' => $this->faker->randomElement([
                \App\Models\Hotel::class,
                \App\Models\Flight::class,
                \App\Models\RentalCar::class
            ]),
            'reservable_id' => $this->faker->numberBetween(1, 100),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'total_price' => $this->faker->randomFloat(2, 50, 5000),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}