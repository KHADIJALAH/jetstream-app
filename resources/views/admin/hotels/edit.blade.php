@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            {{-- En-tête violet --}}
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-violet-600 to-violet-700">
                <h2 class="text-2xl font-bold text-white">Modifier l'hôtel</h2>
            </div>

            <div class="p-6 space-y-6">
                <form method="POST" action="{{ route('admin.hotels.update', $hotel->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Section Informations de base --}}
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Informations de base</h3>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <!-- Nom -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $hotel->name) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                             focus:border-violet-500 focus:ring-2 focus:ring-violet-500
                                             transition duration-200 ease-in-out"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" name="description" rows="4"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                                focus:border-violet-500 focus:ring-2 focus:ring-violet-500
                                                transition duration-200 ease-in-out">{{ old('description', $hotel->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Section Localisation --}}
                    <div class="space-y-4 pt-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Localisation</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Adresse -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                                <input type="text" id="address" name="address" 
                                       value="{{ old('address', $hotel->address) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                             focus:border-violet-500 focus:ring-2 focus:ring-violet-500
                                             transition duration-200 ease-in-out"
                                       required>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Ville -->
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                                <input type="text" id="city" name="city" 
                                       value="{{ old('city', $hotel->city) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                             focus:border-violet-500 focus:ring-2 focus:ring-violet-500
                                             transition duration-200 ease-in-out"
                                       required>
                                @error('city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pays -->
                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700">Pays</label>
                                <input type="text" id="country" name="country" 
                                       value="{{ old('country', $hotel->country) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                             focus:border-violet-500 focus:ring-2 focus:ring-violet-500
                                             transition duration-200 ease-in-out"
                                       required>
                                @error('country')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Classement -->
                            <div>
                                <label for="star_rating" class="block text-sm font-medium text-gray-700">Classement</label>
                                <select id="star_rating" name="star_rating" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                              focus:border-violet-500 focus:ring-2 focus:ring-violet-500
                                              transition duration-200 ease-in-out" required>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ old('star_rating', $hotel->star_rating) == $i ? 'selected' : '' }}>
                                            {{ $i }} étoile{{ $i > 1 ? 's' : '' }}
                                        </option>
                                    @endfor
                                </select>
                                @error('star_rating')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Section Tarification --}}
                    <div class="space-y-4 pt-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Tarification</h3>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <!-- Prix par nuit -->
                            <div>
                                <label for="price_per_night" class="block text-sm font-medium text-gray-700">Prix par nuit (€)</label>
                                <input type="number" id="price_per_night" name="price_per_night" 
                                       value="{{ old('price_per_night', $hotel->price_per_night) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                             focus:border-violet-500 focus:ring-2 focus:ring-violet-500
                                             transition duration-200 ease-in-out"
                                       min="0" step="0.01" required>
                                @error('price_per_night')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Bouton de soumission --}}
                    <div class="pt-6">
                        <button type="submit" 
                                class="w-full flex justify-center items-center px-6 py-3 border border-transparent 
                                      rounded-md shadow-sm text-white bg-violet-600 hover:bg-violet-700 
                                      focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500
                                      transition duration-200 ease-in-out">
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