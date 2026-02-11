@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 sm:mb-0">
            🎯 Gestion des Activités
            <span class="text-sm text-gray-500 font-normal">({{ $activities->total() }} résultats)</span>
        </h1>
        <a href="{{ route('admin.activities.create') }}" 
           class="flex items-center px-5 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-sm transition">
            ➕ Nouvelle Activité
        </a>
    </div>

    @include('partials.alerts')

   

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 text-sm font-semibold text-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left">Nom</th>
                    <th class="px-6 py-3 text-left">Catégorie</th>
                    <th class="px-6 py-3 text-left">Prix</th>
                    <th class="px-6 py-3 text-left">Durée</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($activities as $activity)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">{{ $activity->name }}</td>
                    <td class="px-6 py-4">{{ config('activity_categories')[$activity->category] ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $activity->price }} €</td>
                    <td class="px-6 py-4">{{ $activity->duration }} h</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.activities.edit', $activity->id) }}" class="text-blue-600 hover:underline mr-2">Modifier</a>
                        <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer cette activité ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Aucune activité trouvée.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $activities->withQueryString()->links() }}
    </div>
</div>
@endsection
