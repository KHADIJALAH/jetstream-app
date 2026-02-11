@extends('layouts.app')

@section('title', 'Restaurants')

@section('content')
<div class="bg-white">
    <div class="bg-indigo-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">Expériences Culinaires</h1>
            <p class="text-xl opacity-90">Découvrez les meilleures tables</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid md:grid-cols-3 gap-8">
            @for($i = 0; $i < 6; $i++)
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow">
                <img src="https://via.placeholder.com/400x250" alt="Restaurant" class="w-full h-48 object-cover rounded-t-xl">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold">Le Gourmet</h3>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="ml-1">4.8</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">Cuisine française • €€€</p>
                    <a href="#" class="text-indigo-600 hover:text-indigo-700">Voir le menu →</a>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
@endsection