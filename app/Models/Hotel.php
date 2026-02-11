<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'city',
        'country',
        'star_rating',
        'price_per_night',
        'user_id' // Ajouter ce champ
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations() 
    { 
        return $this->morphMany(Reservation::class, 'reservable'); 
    }

    public function avis()
{
    return $this->hasMany(Avis::class);
}

}
