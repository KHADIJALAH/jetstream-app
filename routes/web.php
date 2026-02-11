<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    HomeController,
    AuthController,
    HotelController,
    ActivityController,
    RestaurantController,
    FlightController,
    VacationRentalController,
    CruiseController,
    RentalCarController,
    ForumController,
    Admin\UserController,
    Admin\BookingController,
    Admin\HotelController as AdminHotelController,
    Admin\FlightController as AdminFlightController,
    Admin\RestaurantController as AdminRestaurantController,
    Admin\ActivityController as AdminActivityController, // Correction de la virgule
    NotificationController,
    DashboardController,
    ReservationController,
    Auth\LoginController,
    Auth\RegisterController,
    UserProfileController,
    AdminController,
    ServiceController
};

// 🔓 Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('home.search');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/feedback', 'feedback')->name('feedback');

// 📩 Formulaire de contact
Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ]);

    Mail::raw("Name: " . $data['name'] . "\nEmail: " . $data['email'] . "\nMessage:\n" . $data['message'], function ($message) {
        $message->to(config('mail.from.address'))->subject('New Contact Form Submission');
    });

    return redirect()->route('contact')->with('success', 'Votre message a été envoyé avec succès !');
})->name('contact.submit');

// 🌍 Services publics
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');

// 🔐 Authentification
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('user.profile');

    Route::get('/settings', function () {
        return view('settings', ['user' => Auth::user()]);
    })->name('settings');
});

// 🛠 Routes Admin
Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Ressources administratives
        Route::resource('hotels', AdminHotelController::class)->except(['show']);
        Route::resource('flights', AdminFlightController::class)->except(['show']);
        Route::resource('restaurants', AdminRestaurantController::class)->except(['show']);
        Route::resource('activities', AdminActivityController::class)->except(['show']);

        // 🧪 Debug
        Route::get('/test-flight', function () {
            return view('admin.flights.index');
        })->name('flights.test');

        // Services
        Route::get('/services', [ServiceController::class, 'index'])->name('services');

        // Réservations
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');

        // Utilisateurs
        Route::resource('users', UserController::class)->except(['show']);
    });

// 🔚 Page 404 personnalisée
Route::fallback(function () {
    return view('errors.404');
});