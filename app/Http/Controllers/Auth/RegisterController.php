<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View; // Added this use statement
use Illuminate\Http\RedirectResponse; // Added this use statement

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register'); // Assuming you have a 'register.blade.php' file in 'resources/views/auth'
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function register(Request $request): RedirectResponse
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:10240', // 10MB max
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'profile_photo_path' => $request->file('profile_photo') ? $request->file('profile_photo')->store('profile_photos', 'public') : null,
        ]);

        // Connexion de l'utilisateur
        Auth::login($user);

        // Redirection après inscription
        return redirect()->route('home');
    }
}