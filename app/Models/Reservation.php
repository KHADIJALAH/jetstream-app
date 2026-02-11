<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bookable_type', // Changed from reservable_type
        'bookable_id',   // Changed from reservable_id
        'start_date',
        'end_date',
        'total_price',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Keep only one polymorphic relationship
    public function bookable()
    {
        return $this->morphTo();
    }
    
    // Remove the reservable() method completely
}