@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-violet-600 to-violet-700">
                <h2 class="text-2xl font-bold text-white">Modifier le vol</h2>
            </div>

            <div class="p-6 space-y-6">
                <form method="POST" action="{{ route('admin.flights.update', $flight->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Compagnie aérienne -->
                        <div>
                            <label for="airline" class="block text-sm font-medium text-gray-700">Compagnie aérienne</label>
                            <input type="text" id="airline" name="airline" value="{{ old('airline', $flight->airline) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   required>
                            @error('airline')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Numéro de vol -->
                        <div>
                            <label for="flight_number" class="block text-sm font-medium text-gray-700">Numéro de vol</label>
                            <input type="text" id="flight_number" name="flight_number" value="{{ old('flight_number', $flight->flight_number) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   required>
                            @error('flight_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Aéroport de départ -->
                        <div>
                            <label for="departure_airport" class="block text-sm font-medium text-gray-700">Aéroport de départ</label>
                            <input type="text" id="departure_airport" name="departure_airport" value="{{ old('departure_airport', $flight->departure_airport) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   required>
                            @error('departure_airport')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Aéroport d'arrivée -->
                        <div>
                            <label for="arrival_airport" class="block text-sm font-medium text-gray-700">Aéroport d'arrivée</label>
                            <input type="text" id="arrival_airport" name="arrival_airport" value="{{ old('arrival_airport', $flight->arrival_airport) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   required>
                            @error('arrival_airport')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date et heure de départ -->
                        <div>
                            <label for="departure_time" class="block text-sm font-medium text-gray-700">Départ</label>
                            <input type="datetime-local" id="departure_time" name="departure_time" 
                                   value="{{ old('departure_time', $flight->departure_time->format('Y-m-d\TH:i')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   required>
                            @error('departure_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date et heure d'arrivée -->
                        <div>
                            <label for="arrival_time" class="block text-sm font-medium text-gray-700">Arrivée</label>
                            <input type="datetime-local" id="arrival_time" name="arrival_time" 
                                   value="{{ old('arrival_time', $flight->arrival_time->format('Y-m-d\TH:i')) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   required>
                            @error('arrival_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Durée -->
                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700">Durée (minutes)</label>
                            <input type="number" id="duration" name="duration" value="{{ old('duration', $flight->duration) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   min="30" required>
                            @error('duration')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Prix -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Prix (€)</label>
                            <input type="number" id="price" name="price" value="{{ old('price', $flight->price) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                         focus:border-violet-500 focus:ring-2 focus:ring-violet-500"
                                   min="0" step="0.01" required>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection