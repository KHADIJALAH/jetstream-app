<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacationRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_type',
        'bedrooms',
        'price_per_night',
        'amenities'
    ];

    protected $casts = [
        'amenities' => 'array'
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
