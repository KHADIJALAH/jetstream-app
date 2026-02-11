<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Activity extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'location',
        'price',
        'duration',
        'category',
        'user_id',
    ];

    protected $casts = [
        'price' => 'float', // Correction: float pour décimales
        'duration' => 'integer',
    ];

    // Relation avec les réservations
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    // Relation avec l'utilisateur (créateur)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Formatage du prix pour l'affichage
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2, ',', ' ') . ' €';
    }

    // Scope de filtrage
    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('location', 'like', '%' . $search . '%');
            });
        })->when($filters['category'] ?? null, function ($query, $category) {
            $query->where('category', $category);
        });
    }
}
