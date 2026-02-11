<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_model',
        'car_type',
        'daily_price',
        'available_from',
        'available_to'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->morphMany(Reservation::class, 'reservable');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}