@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-violet-600 to-violet-700">
                <h2 class="text-2xl font-bold text-white">Créer un nouveau vol</h2>
            </div>

            <div class="p-6 space-y-6">
                <form method="POST" action="{{ route('admin.flights.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Compagnie aérienne -->
                        <div>
                            <label for="airline" class="block text-sm font-medium text-gray-700">Compagnie aérienne</label>
                            <input type="text" id="airline" name="airline" value="{{ old('airline') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   required maxlength="255">
                            @error('airline')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Numéro de vol -->
                        <div>
                            <label for="flight_number" class="block text-sm font-medium text-gray-700">Numéro de vol</label>
                            <input type="text" id="flight_number" name="flight_number" value="{{ old('flight_number') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   required pattern="[A-Z0-9]{2,10}" 
                                   title="2 à 10 caractères alphanumériques (majuscules)">
                            @error('flight_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Aéroport de départ -->
                        <div>
                            <label for="departure_airport" class="block text-sm font-medium text-gray-700">
                                Aéroport de départ
                                <span class="text-xs text-gray-500">(Nom complet)</span>
                            </label>
                            <input type="text" id="departure_airport" name="departure_airport" 
                                   value="{{ old('departure_airport') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   required maxlength="255"
                                   pattern="[A-ZÀ-ÉÈÙÂÊÎÔÛÄËÏÖÜŸÇŒÆa-zà-éèùâêîôûäëïöüÿçœæ\s\-]+"
                                   title="Lettres, espaces et tirets uniquement">
                            @error('departure_airport')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Aéroport d'arrivée -->
                        <div>
                            <label for="arrival_airport" class="block text-sm font-medium text-gray-700">
                                Aéroport d'arrivée
                                <span class="text-xs text-gray-500">(Différent du départ)</span>
                            </label>
                            <input type="text" id="arrival_airport" name="arrival_airport" 
                                   value="{{ old('arrival_airport') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   required maxlength="255"
                                   pattern="[A-ZÀ-ÉÈÙÂÊÎÔÛÄËÏÖÜŸÇŒÆa-zà-éèùâêîôûäëïöüÿçœæ\s\-]+">
                            @error('arrival_airport')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date et heure de départ -->
                        <div>
                            <label for="departure_time" class="block text-sm font-medium text-gray-700">
                                Départ
                                <span class="text-xs text-gray-500">(Date/heure future)</span>
                            </label>
                            <input type="datetime-local" id="departure_time" name="departure_time" 
                                   value="{{ old('departure_time') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   min="{{ now()->addHour()->format('Y-m-d\TH:i') }}"
                                   required>
                            @error('departure_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date et heure d'arrivée -->
                        <div>
                            <label for="arrival_time" class="block text-sm font-medium text-gray-700">
                                Arrivée
                                <span class="text-xs text-gray-500">(Après le départ)</span>
                            </label>
                            <input type="datetime-local" id="arrival_time" name="arrival_time" 
                                   value="{{ old('arrival_time') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   min="{{ now()->addHours(2)->format('Y-m-d\TH:i') }}"
                                   required>
                            @error('arrival_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Durée -->
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700">
                                Durée
                                <span class="text-xs text-gray-500">(30min à 24h)</span>
                            </label>
                            <input type="number" id="duration" name="duration" value="{{ old('duration') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   min="30" max="1440" step="1" 
                                   placeholder="En minutes" required>
                            @error('duration')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Prix -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">
                                Prix
                                <span class="text-xs text-gray-500">(€, max 100 000€)</span>
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">€</span>
                                </div>
                                <input type="number" id="price" name="price" value="{{ old('price') }}"
                                       class="block w-full pl-7 pr-12 rounded-md border-gray-300 
                                             focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                       min="0" max="100000" step="0.01"
                                       placeholder="0.00" required>
                            </div>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" 
                                class="w-full bg-violet-600 hover:bg-violet-700 text-white py-3 px-6 rounded-md 
                                       transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Créer le vol
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection