@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600">
            <h2 class="text-2xl font-bold text-white">Détails de l'hôtel</h2>
        </div>

        <div class="p-6 space-y-6">
            <div class="flex items-center space-x-4">
                <div class="flex-1">
                    <h3 class="text-2xl font-bold text-gray-800">{{ $hotel->name }}</h3>
                    <p class="text-gray-600 mt-2">{{ $hotel->description }}</p>
                </div>
                <div class="text-2xl font-bold text-blue-600">
                    @for($i = 0; $i < $hotel->star_rating; $i++)
                        ⭐
                    @endfor
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $hotel->address }}, {{ $hotel->city }}, {{ $hotel->country }}
                    </div>
                    
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ number_format($hotel->price_per_night, 0, ',', ' ') }} € / nuit
                    </div>
                </div>

                <div class="space-y-2 text-sm text-gray-500">
                    <div>Créé le : {{ $hotel->created_at->format('d/m/Y à H:i') }}</div>
                    <div>Dernière modification : {{ $hotel->updated_at->diffForHumans() }}</div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('admin.hotels.edit', $hotel->id) }}" 
                   class="flex items-center px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-md transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    Modifier
                </a>
                
                <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="flex items-center px-4 py-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-md transition-colors"
                            onclick="return confirm('Confirmer la suppression ?')">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection