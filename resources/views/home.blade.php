<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>JetStream Voyages - Recherche Complète</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Base Styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            color: #334155;
        }
        
        /* Header */
        .header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            z-index: 1000;
            height: 70px;
        }
        
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #6d28d9;
            text-decoration: none;
        }
        
        .nav-links {
            display: flex;
            gap: 25px;
        }
        
        .nav-links a {
            color: #475569;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        
        .nav-links a:hover {
            color: #6d28d9;
        }
        
        /* Main Content */
        .main-content {
            padding-top: 90px;
            min-height: calc(100vh - 160px);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Hero Section - Slideshow Version */
        .hero {
            position: relative;
            overflow: hidden;
            height: 500px;
            color: white;
            text-align: center;
            border-radius: 12px;
            margin-bottom: 40px;
        }
        
        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1s ease-in-out, transform 5s linear;
            transform: translateX(0);
            z-index: 1;
        }
        
        .hero-slide.active {
            opacity: 1;
            transform: translateX(0);
        }
        
        .hero-slide.next {
            transform: translateX(100%);
        }
        
        .hero-slide.prev {
            transform: translateX(-100%);
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            padding-top: 80px;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto 30px;
        }
        
        /* Search Container */
        .search-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        
        /* Search Tabs */
        .search-tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .search-tab {
            padding: 10px 20px;
            cursor: pointer;
            font-weight: 500;
            color: #64748b;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
        }
        
        .search-tab.active {
            color: #6d28d9;
            border-bottom-color: #6d28d9;
        }
        
        .search-tab:hover:not(.active) {
            color: #475569;
            border-bottom-color: #cbd5e1;
        }
        
        .search-content {
            display: none;
        }
        
        .search-content.active {
            display: block;
        }
        
        /* Search Forms */
        .search-form {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }
        
        .form-group {
            position: relative;
        }
        
        .form-group label {
            display: block;
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            background-color: white;
            cursor: pointer;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }
        
        .search-button {
            grid-column: 1 / -1;
            background-color: #6d28d9;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 10px;
        }
        
        .search-button:hover {
            background-color: #5b21b6;
        }
        
        .icon {
            position: absolute;
            right: 15px;
            top: 38px;
            color: #64748b;
        }
        
        /* Occupants Modal */
        .occupants-modal {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            width: 300px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }
        
        .occupant-option {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .occupant-option:last-child {
            margin-bottom: 0;
        }
        
        .counter {
            display: flex;
            align-items: center;
        }
        
        .counter-btn {
            width: 30px;
            height: 30px;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .counter-value {
            margin: 0 15px;
            min-width: 20px;
            text-align: center;
        }
        
        /* Destinations Section */
        .destinations {
            padding: 60px 0;
        }
        
        .section-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 40px;
            color: #1e293b;
        }
        
        .destination-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }
        
        .destination-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .destination-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .destination-image {
            height: 200px;
            background-size: cover;
            background-position: center;
        }
        
        .destination-info {
            padding: 20px;
        }
        
        .destination-info h3 {
            margin: 0 0 10px;
            font-size: 1.2rem;
        }
        
        .destination-info p {
            color: #64748b;
            margin-bottom: 15px;
        }
        
        .destination-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .destination-link {
            color: #6d28d9;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-size: 0.9rem;
            padding: 5px 10px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            transition: all 0.2s;
        }
        
        .destination-link:hover {
            background-color: #f3f0ff;
        }
        
        .destination-link svg {
            margin-left: 5px;
            transition: transform 0.2s;
        }
        
        .destination-link:hover svg {
            transform: translateX(3px);
        }
        
        /* Footer */
        .footer {
            background-color: #1e293b;
            color: white;
            padding: 40px 0;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }
        
        .footer-column h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        
        .footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-column li {
            margin-bottom: 10px;
        }
        
        .footer-column a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .footer-column a:hover {
            color: white;
        }
        
        .copyright {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #334155;
            color: #94a3b8;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .destination-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .footer-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .search-form {
                grid-template-columns: 1fr;
            }
            
            .nav-links {
                display: none;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .destination-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-container {
                grid-template-columns: 1fr;
            }
            
            .search-tabs {
                flex-wrap: wrap;
            }
            
            .search-tab {
                flex: 1;
                text-align: center;
                padding: 8px 10px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    @extends('layouts.app')
    @section('content')

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section with Slideshow -->
        <div class="container">
            <div class="hero">
                <!-- Slides -->
                <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');"></div>
                <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1431274172761-fca41d930114?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');"></div>
                <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1518544866330-95a2b4134b9d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');"></div>
                <div class="hero-slide" style="background-image: url('https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');"></div>
                
                <!-- Content -->
                <div class="hero-content">
                    <h1>Trouvez tout pour votre voyage parfait</h1>
                    <p>Comparez et réservez des hôtels, vols et activités dans le monde entier</p>
                </div>
            </div>
        </div>

        <!-- Search Container -->
        <div class="container">
            <div class="search-container">
                <div class="search-tabs">
                    <div class="search-tab active" data-tab="hotels">Hôtels</div>
                    <div class="search-tab" data-tab="flights">Vols</div>
                    <div class="search-tab" data-tab="activities">Activités</div>
                </div>
                
                <!-- Hotels Search -->
                <div class="search-content active" id="hotels-search">
                    <form class="search-form" method="GET" action="{{ route('hotels.index') }}">
                        <!-- Destination -->
                        <div class="form-group">
                            <label for="hotel-destination">Destination</label>
                            <input 
                                type="text" 
                                id="hotel-destination" 
                                name="destination" 
                                class="form-control"
                                placeholder="Entrez une ville ou un hôtel"
                                autocomplete="off"
                                required
                            >
                            <svg class="icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        
                        <!-- Dates -->
                        <div class="form-group">
                            <label for="hotel-date-range">Dates</label>
                            <input 
                                type="text" 
                                id="hotel-date-range" 
                                class="form-control"
                                placeholder="Sélectionnez des dates"
                                value="{{ date('d/m/Y') }} - {{ date('d/m/Y', strtotime('+1 day')) }}"
                                required
                            >
                            <input type="hidden" id="hotel-checkin" name="checkin" value="{{ date('Y-m-d') }}">
                            <input type="hidden" id="hotel-checkout" name="checkout" value="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            <svg class="icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        
                        <!-- Duration -->
                        <div class="form-group">
                            <label>Durée</label>
                            <input 
                                type="text" 
                                class="form-control"
                                id="hotel-duration"
                                value="1 nuit"
                                readonly
                            >
                        </div>
                        
                        <!-- Occupants -->
                        <div class="form-group">
                            <label>Occupants</label>
                            <div class="form-control" id="hotel-occupants-display">
                                1 Chambre, 2 Adultes
                            </div>
                            <input type="hidden" id="hotel-rooms" name="rooms" value="1">
                            <input type="hidden" id="hotel-adults" name="adults" value="2">
                            <input type="hidden" id="hotel-children" name="children" value="0">
                            <svg class="icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            
                            <!-- Occupants Modal -->
                            <div class="occupants-modal" id="hotel-occupants-modal">
                                <div class="occupant-option">
                                    <span>Chambres</span>
                                    <div class="counter">
                                        <button type="button" class="counter-btn" id="decrease-hotel-rooms">-</button>
                                        <span class="counter-value" id="hotel-rooms-count">1</span>
                                        <button type="button" class="counter-btn" id="increase-hotel-rooms">+</button>
                                    </div>
                                </div>
                                <div class="occupant-option">
                                    <span>Adultes</span>
                                    <div class="counter">
                                        <button type="button" class="counter-btn" id="decrease-hotel-adults">-</button>
                                        <span class="counter-value" id="hotel-adults-count">2</span>
                                        <button type="button" class="counter-btn" id="increase-hotel-adults">+</button>
                                    </div>
                                </div>
                                <div class="occupant-option">
                                    <span>Enfants</span>
                                    <div class="counter">
                                        <button type="button" class="counter-btn" id="decrease-hotel-children">-</button>
                                        <span class="counter-value" id="hotel-children-count">0</span>
                                        <button type="button" class="counter-btn" id="increase-hotel-children">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="search-button">
                            Rechercher des hôtels
                        </button>
                    </form>
                </div>
                
                <!-- Flights Search -->
                <div class="search-content" id="flights-search">
                    <form class="search-form" method="GET" action="{{ route('flights.index') }}">
                        <!-- Origin -->
                        <div class="form-group">
                            <label for="flight-origin">Origine</label>
                            <input 
                                type="text" 
                                id="flight-origin" 
                                name="origin" 
                                class="form-control"
                                placeholder="Ville de départ"
                                autocomplete="off"
                                required
                            >
                            <svg class="icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        
                        <!-- Destination -->
                        <div class="form-group">
                            <label for="flight-destination">Destination</label>
                            <input 
                                type="text" 
                                id="flight-destination" 
                                name="destination" 
                                class="form-control"
                                placeholder="Ville d'arrivée"
                                autocomplete="off"
                                required
                            >
                            <svg class="icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        
                        <!-- Date -->
                        <div class="form-group">
                            <label for="flight-date">Date de départ</label>
                            <input 
                                type="text" 
                                id="flight-date" 
                                class="form-control"
                                placeholder="Sélectionnez une date"
                                value="{{ date('d/m/Y') }}"
                                required
                            >
                            <input type="hidden" id="flight-date-value" name="date" value="{{ date('Y-m-d') }}">
                            <svg class="icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        
                        <!-- Passengers -->
                        <div class="form-group">
                            <label>Passagers</label>
                            <div class="form-control" id="flight-passengers-display">
                                1 Adulte
                            </div>
                            <input type="hidden" id="flight-adults" name="adults" value="1">
                            <input type="hidden" id="flight-children" name="children" value="0">
                            <svg class="icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            
                            <!-- Passengers Modal -->
                            <div class="occupants-modal" id="flight-passengers-modal">
                                <div class="occupant-option">
                                    <span>Adultes</span>
                                    <div class="counter">
                                        <button type="button" class="counter-btn" id="decrease-flight-adults">-</button>
                                        <span class="counter-value" id="flight-adults-count">1</span>
                                        <button type="button" class="counter-btn" id="increase-flight-adults">+</button>
                                    </div>
                                </div>
                                <div class="occupant-option">
                                    <span>Enfants</span>
                                    <div class="counter">
                                        <button type="button" class="counter-btn" id="decrease-flight-children">-</button>
                                        <span class="counter-value" id="flight-children-count">0</span>
                                        <button type="button" class="counter-btn" id="increase-flight-children">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="search-button">
                            Rechercher des vols
                        </button>
                    </form>
                </div>
                
                <!-- Activities Search -->
                <div class="search-content" id="activities-search">
                    <form class="search-form" method="GET" action="{{ route('activities.index') }}">
                        <!-- Destination -->
                        <div class="form-group">
                            <label for="activity-destination">Lieu</label>
                            <input 
                                type="text" 
                                id="activity-destination" 
                                name="destination" 
                                class="form-control"
                                placeholder="Entrez une ville"
                                autocomplete="off"
                                required
                            >
                            <svg class="icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        
                        <!-- Date -->
                        <div class="form-group">
                            <label for="activity-date">Date</label>
                            <input 
                                type="text" 
                                id="activity-date" 
                                class="form-control"
                                placeholder="Sélectionnez une date"
                                value="{{ date('d/m/Y') }}"
                                required
                            >
                            <input type="hidden" id="activity-date-value" name="date" value="{{ date('Y-m-d') }}">
                            <svg class="icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        
                        <!-- Participants -->
                        <div class="form-group">
                            <label>Participants</label>
                            <div class="form-control" id="activity-participants-display">
                                2 Personnes
                            </div>
                            <input type="hidden" id="activity-participants" name="participants" value="2">
                            <svg class="icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            
                            <!-- Participants Modal -->
                            <div class="occupants-modal" id="activity-participants-modal">
                                <div class="occupant-option">
                                    <span>Personnes</span>
                                    <div class="counter">
                                        <button type="button" class="counter-btn" id="decrease-activity-participants">-</button>
                                        <span class="counter-value" id="activity-participants-count">2</span>
                                        <button type="button" class="counter-btn" id="increase-activity-participants">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="search-button">
                            Rechercher des activités
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Popular Destinations -->
        <section class="destinations container">
            <h2 class="section-title">Destinations populaires</h2>
            
            <div class="destination-grid">
                <!-- Paris -->
                <div class="destination-card">
                    <div class="destination-image" style="background-image: url('https://images.unsplash.com/photo-1431274172761-fca41d930114?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');"></div>
                    <div class="destination-info">
                        <h3>Paris, France</h3>
                        <p>Découvrez la ville lumière et ses monuments emblématiques.</p>
                        <div class="destination-links">
                            <a href="{{ route('hotels.index', ['destination' => 'Paris']) }}" class="destination-link">
                                Hôtels
                            </a>
                            <a href="{{ route('flights.index', ['destination' => 'Paris']) }}" class="destination-link">
                                Vols
                            </a>
                            <a href="{{ route('activities.index', ['destination' => 'Paris']) }}" class="destination-link">
                                Activités
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Marrakech -->
                <div class="destination-card">
                    <div class="destination-image" style="background-image: url('https://images.unsplash.com/photo-1518544866330-95a2b4134b9d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');"></div>
                    <div class="destination-info">
                        <h3>Marrakech, Maroc</h3>
                        <p>Plongez dans l'atmosphère envoûtante de la ville ocre.</p>
                        <div class="destination-links">
                            <a href="{{ route('hotels.index', ['destination' => 'Marrakech']) }}" class="destination-link">
                                Hôtels
                            </a>
                            <a href="{{ route('flights.index', ['destination' => 'Marrakech']) }}" class="destination-link">
                                Vols
                            </a>
                            <a href="{{ route('activities.index', ['destination' => 'Marrakech']) }}" class="destination-link">
                                Activités
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- New York -->
                <div class="destination-card">
                    <div class="destination-image" style="background-image: url('https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');"></div>
                    <div class="destination-info">
                        <h3>New York, USA</h3>
                        <p>Expériencez l'énergie incomparable de la Grosse Pomme.</p>
                        <div class="destination-links">
                            <a href="{{ route('hotels.index', ['destination' => 'New York']) }}" class="destination-link">
                                Hôtels
                            </a>
                            <a href="{{ route('flights.index', ['destination' => 'New York']) }}" class="destination-link">
                                Vols
                            </a>
                            <a href="{{ route('activities.index', ['destination' => 'New York']) }}" class="destination-link">
                                Activités
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    @endsection

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
    <script>
        // Background Slideshow
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.hero-slide');
            let currentSlide = 0;
            
            // Show first slide
            slides[currentSlide].classList.add('active');
            
            function nextSlide() {
                // Mark current slide as previous (for animation)
                slides[currentSlide].classList.remove('active');
                slides[currentSlide].classList.add('prev');
                
                // Calculate next slide index
                currentSlide = (currentSlide + 1) % slides.length;
                
                // Prepare next slide
                slides[currentSlide].classList.remove('prev');
                slides[currentSlide].classList.add('next');
                
                // Force reflow to trigger animation
                void slides[currentSlide].offsetWidth;
                
                // Activate next slide
                slides[currentSlide].classList.remove('next');
                slides[currentSlide].classList.add('active');
                
                // Remove prev class from previous slide after animation
                setTimeout(() => {
                    const prevSlide = (currentSlide - 1 + slides.length) % slides.length;
                    slides[prevSlide].classList.remove('prev');
                }, 1000);
            }
            
            // Change slide every 5 seconds
            setInterval(nextSlide, 5000);
        });

        // Tab switching functionality
        const tabs = document.querySelectorAll('.search-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs and content
                document.querySelectorAll('.search-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.search-content').forEach(c => c.classList.remove('active'));
                
                // Add active class to clicked tab and corresponding content
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(`${tabId}-search`).classList.add('active');
            });
        });

        // Hotels date picker (range)
        flatpickr("#hotel-date-range", {
            mode: "range",
            dateFormat: "d/m/Y",
            defaultDate: ["{{ date('d/m/Y') }}", "{{ date('d/m/Y', strtotime('+1 day')) }}"],
            locale: "fr",
            minDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    const start = selectedDates[0];
                    const end = selectedDates[1];
                    const nights = Math.round((end - start) / (1000 * 60 * 60 * 24));
                    
                    // Update hidden fields
                    document.getElementById('hotel-checkin').value = formatDateForServer(start);
                    document.getElementById('hotel-checkout').value = formatDateForServer(end);
                    
                    // Update duration display
                    document.getElementById('hotel-duration').value = 
                        nights + ' nuit' + (nights > 1 ? 's' : '');
                }
            }
        });

        // Flights date picker (single)
        flatpickr("#flight-date", {
            dateFormat: "d/m/Y",
            defaultDate: "{{ date('d/m/Y') }}",
            locale: "fr",
            minDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 1) {
                    document.getElementById('flight-date-value').value = formatDateForServer(selectedDates[0]);
                }
            }
        });

        // Activities date picker (single)
        flatpickr("#activity-date", {
            dateFormat: "d/m/Y",
            defaultDate: "{{ date('d/m/Y') }}",
            locale: "fr",
            minDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 1) {
                    document.getElementById('activity-date-value').value = formatDateForServer(selectedDates[0]);
                }
            }
        });

        function formatDateForServer(date) {
            return date.getFullYear() + '-' + 
                   String(date.getMonth() + 1).padStart(2, '0') + '-' + 
                   String(date.getDate()).padStart(2, '0');
        }

        // Hotels occupants management
        const hotelOccupantsDisplay = document.getElementById('hotel-occupants-display');
        const hotelOccupantsModal = document.getElementById('hotel-occupants-modal');
        let hotelRooms = 1;
        let hotelAdults = 2;
        let hotelChildren = 0;

        hotelOccupantsDisplay.addEventListener('click', function(e) {
            e.stopPropagation();
            hotelOccupantsModal.style.display = hotelOccupantsModal.style.display === 'block' ? 'none' : 'block';
        });

        document.getElementById('increase-hotel-rooms').addEventListener('click', function() {
            hotelRooms++;
            document.getElementById('hotel-rooms-count').textContent = hotelRooms;
            document.getElementById('hotel-rooms').value = hotelRooms;
            updateHotelOccupantsDisplay();
        });

        document.getElementById('decrease-hotel-rooms').addEventListener('click', function() {
            if (hotelRooms > 1) {
                hotelRooms--;
                document.getElementById('hotel-rooms-count').textContent = hotelRooms;
                document.getElementById('hotel-rooms').value = hotelRooms;
                updateHotelOccupantsDisplay();
            }
        });

        document.getElementById('increase-hotel-adults').addEventListener('click', function() {
            hotelAdults++;
            document.getElementById('hotel-adults-count').textContent = hotelAdults;
            document.getElementById('hotel-adults').value = hotelAdults;
            updateHotelOccupantsDisplay();
        });

        document.getElementById('decrease-hotel-adults').addEventListener('click', function() {
            if (hotelAdults > 1) {
                hotelAdults--;
                document.getElementById('hotel-adults-count').textContent = hotelAdults;
                document.getElementById('hotel-adults').value = hotelAdults;
                updateHotelOccupantsDisplay();
            }
        });

        document.getElementById('increase-hotel-children').addEventListener('click', function() {
            hotelChildren++;
            document.getElementById('hotel-children-count').textContent = hotelChildren;
            document.getElementById('hotel-children').value = hotelChildren;
            updateHotelOccupantsDisplay();
        });

        document.getElementById('decrease-hotel-children').addEventListener('click', function() {
            if (hotelChildren > 0) {
                hotelChildren--;
                document.getElementById('hotel-children-count').textContent = hotelChildren;
                document.getElementById('hotel-children').value = hotelChildren;
                updateHotelOccupantsDisplay();
            }
        });

        function updateHotelOccupantsDisplay() {
            let displayText = hotelRooms + ' Chambre' + (hotelRooms > 1 ? 's' : '') + ', ' + 
                             hotelAdults + ' Adulte' + (hotelAdults > 1 ? 's' : '');
            
            if (hotelChildren > 0) {
                displayText += ', ' + hotelChildren + ' Enfant' + (hotelChildren > 1 ? 's' : '');
            }
            
            hotelOccupantsDisplay.textContent = displayText;
        }

        // Flights passengers management
        const flightPassengersDisplay = document.getElementById('flight-passengers-display');
        const flightPassengersModal = document.getElementById('flight-passengers-modal');
        let flightAdults = 1;
        let flightChildren = 0;

        flightPassengersDisplay.addEventListener('click', function(e) {
            e.stopPropagation();
            flightPassengersModal.style.display = flightPassengersModal.style.display === 'block' ? 'none' : 'block';
        });

        document.getElementById('increase-flight-adults').addEventListener('click', function() {
            flightAdults++;
            document.getElementById('flight-adults-count').textContent = flightAdults;
            document.getElementById('flight-adults').value = flightAdults;
            updateFlightPassengersDisplay();
        });

        document.getElementById('decrease-flight-adults').addEventListener('click', function() {
            if (flightAdults > 1) {
                flightAdults--;
                document.getElementById('flight-adults-count').textContent = flightAdults;
                document.getElementById('flight-adults').value = flightAdults;
                updateFlightPassengersDisplay();
            }
        });

        document.getElementById('increase-flight-children').addEventListener('click', function() {
            flightChildren++;
            document.getElementById('flight-children-count').textContent = flightChildren;
            document.getElementById('flight-children').value = flightChildren;
            updateFlightPassengersDisplay();
        });

        document.getElementById('decrease-flight-children').addEventListener('click', function() {
            if (flightChildren > 0) {
                flightChildren--;
                document.getElementById('flight-children-count').textContent = flightChildren;
                document.getElementById('flight-children').value = flightChildren;
                updateFlightPassengersDisplay();
            }
        });

        function updateFlightPassengersDisplay() {
            let displayText = flightAdults + ' Adulte' + (flightAdults > 1 ? 's' : '');
            
            if (flightChildren > 0) {
                displayText += ', ' + flightChildren + ' Enfant' + (flightChildren > 1 ? 's' : '');
            }
            
            flightPassengersDisplay.textContent = displayText;
        }

        // Activities participants management
        const activityParticipantsDisplay = document.getElementById('activity-participants-display');
        const activityParticipantsModal = document.getElementById('activity-participants-modal');
        let activityParticipants = 2;

        activityParticipantsDisplay.addEventListener('click', function(e) {
            e.stopPropagation();
            activityParticipantsModal.style.display = activityParticipantsModal.style.display === 'block' ? 'none' : 'block';
        });

        document.getElementById('increase-activity-participants').addEventListener('click', function() {
            activityParticipants++;
            document.getElementById('activity-participants-count').textContent = activityParticipants;
            document.getElementById('activity-participants').value = activityParticipants;
            updateActivityParticipantsDisplay();
        });

        document.getElementById('decrease-activity-participants').addEventListener('click', function() {
            if (activityParticipants > 1) {
                activityParticipants--;
                document.getElementById('activity-participants-count').textContent = activityParticipants;
                document.getElementById('activity-participants').value = activityParticipants;
                updateActivityParticipantsDisplay();
            }
        });

        function updateActivityParticipantsDisplay() {
            activityParticipantsDisplay.textContent = activityParticipants + ' Personne' + (activityParticipants > 1 ? 's' : '');
        }

        // Close modals when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.occupants-modal').forEach(modal => {
                modal.style.display = 'none';
            });
        });

        // Prevent modal close when clicking inside
        document.querySelectorAll('.occupants-modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>
</body>
</html>