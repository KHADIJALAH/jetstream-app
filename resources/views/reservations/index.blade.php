@extends('layouts.app')

@section('title', 'Réservations')

@section('content')
<div class="bg-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold mb-8">Mes Réservations</h1>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Détails</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Statut</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @for($i = 0; $i < 3; $i++)
                    <tr>
                        <td class="px-6 py-4">15/07/2024</td>
                        <td class="px-6 py-4">
                            <div class="font-medium">Hôtel Luxe - Suite Deluxe</div>
                            <div class="text-gray-600">2 nuits - €598</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">Confirmée</span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-indigo-600 hover:text-indigo-700">Détails</a>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection