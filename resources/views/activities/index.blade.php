@extends('layouts.app')

@section('title', 'Activités')

@section('content')
<div class="bg-white">
    <div class="bg-indigo-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">Activités & Expériences</h1>
            <p class="text-xl opacity-90">Découvrez des aventures uniques</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid md:grid-cols-3 gap-8">
            @for($i = 0; $i < 6; $i++)
            <div class="relative group overflow-hidden rounded-xl">
                <img src="https://via.placeholder.com/400x300" alt="Activité" 
                     class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6 text-white">
                    <h3 class="text-xl font-bold mb-2">Visite Guidée</h3>
                    <p class="text-sm">À partir de €49/pers</p>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
@endsection