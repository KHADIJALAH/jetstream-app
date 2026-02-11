<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    // Attributs qui peuvent être assignés en masse
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
        'is_admin',
    ];
    

    // Attributs qui doivent être masqués
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    // Attributs supplémentaires calculés
    protected $appends = [
        'profile_photo_url',
    ];

    // Conversion des types de données des colonnes
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean', // Assure que le champ 'is_admin' est traité comme un booléen
        ];
    }

    // Relation avec les réservations
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    // Relation avec les hôtels
    public function hotels(): HasMany
    {
        return $this->hasMany(Hotel::class);
    }

    // Relation avec les notifications de l'utilisateur
    public function userNotifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    // Relation avec les services
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);  // Relation avec le modèle Service (si tu en as un)
    }

    // Méthode pour vérifier si l'utilisateur est un administrateur
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }
}
