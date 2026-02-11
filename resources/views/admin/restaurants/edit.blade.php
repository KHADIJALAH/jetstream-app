@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600">
                <h2 class="text-2xl font-bold text-white">Modifier le Restaurant</h2>
            </div>

            <div class="p-6 space-y-6">
                <form method="POST" action="{{ route('admin.restaurants.update', $restaurant->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Informations de base</h3>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <!-- Nom -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $restaurant->name) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                             focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                                             transition duration-200 ease-in-out"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Type de cuisine -->
                            <div>
                                <label for="cuisine_type" class="block text-sm font-medium text-gray-700">Type de cuisine</label>
                                <select id="cuisine_type" name="cuisine_type" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                              focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                                              transition duration-200 ease-in-out" required>
                                    @foreach($cuisineTypes as $type)
                                        <option value="{{ $type }}" {{ old('cuisine_type', $restaurant->cuisine_type) == $type ? 'selected' : '' }}>
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cuisine_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 pt-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Coordonnées</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Adresse -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                                <input type="text" id="address" name="address" value="{{ old('address', $restaurant->address) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                             focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                                             transition duration-200 ease-in-out"
                                       required>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone', $restaurant->phone) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                             focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                                             transition duration-200 ease-in-out"
                                       required>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 pt-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Image</h3>
                        
                        <div class="grid grid-cols-1 gap-4">
                            <!-- Image actuelle -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Image actuelle</label>
                                <img src="{{ $restaurant->getFirstMediaUrl('restaurants') }}" 
                                     class="w-64 h-48 object-cover rounded-lg shadow-sm border border-gray-200">
                            </div>

                            <!-- Nouvelle image -->
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">Changer l'image</label>
                                <input type="file" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*"
                                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" 
                                class="w-full flex justify-center items-center px-6 py-3 border border-transparent 
                                      rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 
                                      focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
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