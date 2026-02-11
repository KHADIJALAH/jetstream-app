@extends('layouts.app')

@section('title', 'Vols Disponibles')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 to-indigo-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Vols Disponibles ✈️</h1>

        <!-- Filtres -->
        <div class="mb-8 bg-white p-6 rounded-xl shadow-sm">
            <div class="flex flex-wrap gap-4 items-center">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Destination</label>
                    <input type="text" class="w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date de départ</label>
                    <input type="date" class="w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                </div>
                <button class="self-end bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                    🔍 Filtrer
                </button>
            </div>
        </div>

        <!-- Liste des vols -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($flights as $flight)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                <!-- Image du vol -->
                <div class="h-48 bg-blue-100 rounded-t-xl relative overflow-hidden">
                    <img src="https://picsum.photos/400/300?random={{ $loop->index }}" 
                         alt="Avion" 
                         class="w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                        <h3 class="text-xl font-bold text-white">
                            {{ $flight->departure_airport }} → {{ $flight->arrival_airport }}
                        </h3>
                    </div>
                </div>

                <!-- Détails du vol -->
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-indigo-100 p-2 rounded-lg">
                            <span class="text-indigo-600 font-medium">✈️ {{ $flight->airline }}</span>
                        </div>
                        <span class="text-sm text-gray-500">Vol #{{ $flight->flight_number }}</span>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <span class="text-green-600">🕒</span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Départ</p>
                                <p class="font-medium">{{ $flight->departure_time->format('H:i') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                <span class="text-purple-600">📅</span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Date</p>
                                <p class="font-medium">{{ $flight->departure_time->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600">⏳</span>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Durée</p>
                                <p class="font-medium">2h 15m</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <div>
                            <p class="text-2xl font-bold text-gray-800">
                                {{ number_format($flight->price, 0, ',', ' ') }} MAD
                            </p>
                            <p class="text-sm text-gray-500">Prix par personne</p>
                        </div>
                        <a href="{{ route('flights.show', $flight->id) }}" 
                           class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
                            Réserver
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $flights->links() }}
        </div>
    </div>
</div>
@endsection