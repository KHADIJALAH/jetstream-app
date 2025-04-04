<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use Illuminate\Routing\Route;

Route::get('/', function () {
    return view('index'); // Page d'accueil
});

// Routes pour l'authentification
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Routes pour les hôtels
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');

// Routes pour les activités
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');

// Routes pour les restaurants
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{id}', [RestaurantController::class, 'show'])->name('restaurants.show');

// Routes pour les réservations
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');