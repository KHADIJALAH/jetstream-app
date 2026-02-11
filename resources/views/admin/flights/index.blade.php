@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 sm:mb-0">
            ✈ Gestion des Vols
        </h1>
        <a href="{{ route('admin.flights.create') }}" 
           class="flex items-center px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-sm transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Nouveau Vol
        </a>
    </div>

    @if(session('success'))
    <div class="p-4 mb-6 bg-green-50 border-l-4 border-green-400 text-green-700 rounded-lg shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Compagnie</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vol</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Départ</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Arrivée</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durée</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($flights as $flight)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $flight->airline }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $flight->flight_number }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $flight->departure_airport }}<br>
                        <span class="text-xs text-gray-500">{{ $flight->departure_time->format('d/m/Y H:i') }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $flight->arrival_airport }}<br>
                        <span class="text-xs text-gray-500">{{ $flight->arrival_time->format('d/m/Y H:i') }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $flight->duration }} min</td>
                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ number_format($flight->price, 0, ',', ' ') }} €</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('admin.flights.edit', $flight->id) }}" 
                               class="flex items-center px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-md text-sm transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Modifier
                            </a>
                            
                            <form action="{{ route('admin.flights.destroy', $flight->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="flex items-center px-3 py-2 bg-red-100 hover:bg-red-200 text-red-600 rounded-md text-sm transition-colors"
                                        onclick="return confirm('Supprimer ce vol ?')">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection