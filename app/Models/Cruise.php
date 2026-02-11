<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cruise extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cruise_line',
        'itinerary',
        'start_date',
        'end_date',
        'price'
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