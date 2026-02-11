<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        nav a {
            position: relative;
            text-decoration: none;
            transition: color 0.2s ease;
            color: #4B5563;
        }

        nav a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 100%;
            height: 2px;
            background-color: #4B5563;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        nav a:hover {
            color: #1d4ed8;
        }

        nav a:hover::after {
            transform: scaleX(1);
        }

        .logout-button {
            background-color: #6B5BCA;
            padding: 10px 16px;
            border-radius: 0.5rem;
            transition: background-color 0.2s, transform 0.2s;
        }

        .logout-button:hover {
            background-color: #A78BFA;
            transform: scale(1.05);
        }

        .header-height {
            height: 80px;
        }

        .header-content {
            height: 100%;
            display: flex;
            align-items: center;
        }

        .header-bg {
            background-color: #E9D5FF;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head-scripts')
</head>
<body class="font-sans antialiased bg-gray-50">
    <nav class="shadow-md fixed w-full z-50 header-height header-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full header-content">
            <div class="flex justify-between items-center h-full w-full">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center text-2xl font-bold text-indigo-600">
                        JetStream
                    </a>
                </div>

                <div class="hidden sm:flex sm:items-center space-x-8">
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Dashboard</a>
                            <a href="{{ route('admin.hotels.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Hôtels</a>
                            <a href="{{ route('admin.flights.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Vols</a>
                            <a href="{{ route('admin.restaurants.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Restaurants</a>
                            <a href="{{ route('admin.activities.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Activités</a>
                        @else
                            <a href="{{ route('hotels.index') }}" class="{{ request()->routeIs('hotels.*') ? 'font-bold text-indigo-800' : 'text-gray-600 hover:text-indigo-600' }}">
                                Hôtels
                            </a>
                            <a href="{{ route('flights.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Vols</a>
                            <a href="{{ route('activities.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Activités</a>
                            <a href="{{ route('restaurants.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Restaurants</a>
                        @endif
                    @else
                        <a href="{{ route('hotels.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Hôtels</a>
                        <a href="{{ route('flights.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Vols</a>
                        <a href="{{ route('activities.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Activités</a>
                        <a href="{{ route('restaurants.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors">Restaurants</a>
                    @endauth

                    @auth
                        <div class="relative group">
                            <button class="text-gray-600 hover:text-indigo-600 flex items-center">
                                Mon compte
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-lg p-2 min-w-[200px]">
                                <a href="{{ route('reservations.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">Mes réservations</a>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-button text-white font-medium hover:bg-purple-600 transition duration-200 focus:outline-none">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600">Connexion</a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-200">Inscription</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-20 min-h-screen bg-purple-100">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center md:text-left grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">JetStream</h3>
                    <p class="text-gray-400">Votre compagnon de voyage depuis 2023</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Liens utiles</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white">À propos</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Légal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">CGU</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Confidentialité</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} JetStream. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
