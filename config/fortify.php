<?php

use Laravel\Fortify\Features;

return [
    'guard' => 'web',
    'passwords' => 'users',
    'username' => 'email',
    'email' => 'email',
    'lowercase_usernames' => true,
    'home' => '/admin/dashboard', // Redirection après authentification
    'prefix' => '',
    'domain' => null,
    'middleware' => ['web'],
    
    'limiters' => [
        'login' => 'login',
        'two-factor' => 'two-factor',
    ],

    'views' => true,

    'features' => [
        // Désactivez l'inscription publique si nécessaire
        // Features::registration(),
        
        Features::resetPasswords(),
        Features::emailVerification(),
        Features::updateProfileInformation(),
        Features::updatePasswords(),
        
        // Configuration 2FA pour les administrateurs
        Features::twoFactorAuthentication([
            'confirm' => true,
            'confirmPassword' => true,
            'window' => 30,
        ]),
    ],

    // Configuration supplémentaire pour l'admin
    'admin' => [
        'middleware' => ['auth', 'admin'],
        'paths' => [
            'dashboard' => '/admin/dashboard',
            'restaurants' => '/admin/restaurants',
            'users' => '/admin/users'
        ],
        'pagination' => [
            'per_page' => 10
        ]
    ],
    
    // Configuration des médias
    'media' => [
        'restaurants' => [
            'collection' => 'restaurants',
            'disk' => 'public',
            'conversions' => [
                'thumb' => ['width' => 100, 'height' => 100],
                'preview' => ['width' => 300, 'height' => 300]
            ]
        ]
    ]
];