<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Restaurant extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name', 
        'cuisine_type', 
        'address', 
        'phone',
        'rating',
        'opening_hours',
        'slug'
    ];

    protected $casts = [
        'opening_hours' => 'array',
        'rating' => 'decimal:1'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('restaurants')
             ->singleFile();
    }
}
