<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'flight_number',
        'airline',
        'departure_airport',
        'arrival_airport',
        'departure_time',
        'arrival_time',
        'duration',
        'price'
    ];

    protected $casts = [
        'departure_time' => 'datetime:Y-m-d H:i:s',
        'arrival_time' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope pour les vols disponibles (non expirés)
     */
    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('departure_time', '>', now());
    }

    /**
     * Formatage personnalisé pour l'heure de départ
     */
    public function getFormattedDepartureTimeAttribute(): string
    {
        return $this->departure_time->format('d/m/Y H:i');
    }

    /**
     * Formatage personnalisé pour l'heure d'arrivée
     */
    public function getFormattedArrivalTimeAttribute(): string
    {
        return $this->arrival_time->format('d/m/Y H:i');
    }

    /**
     * Accesseur pour la durée formatée
     */
    public function getFormattedDurationAttribute(): string
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;
        
        return sprintf('%dh%02d', $hours, $minutes);
    }
}