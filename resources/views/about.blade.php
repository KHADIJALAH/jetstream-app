@extends('layouts.app')

@section('title', 'À propos')

@section('content')
<div class="bg-white">
    <!-- Hero Section -->
    <div class="bg-indigo-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">Notre histoire</h1>
            <p class="text-xl opacity-90">Redéfinir l'expérience de voyage depuis 2023</p>
        </div>
    </div>

    <!-- Contenu principal -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="prose-lg text-gray-600 max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Notre mission</h2>
            <p class="mb-8">Chez JetStream, nous nous engageons à fournir une expérience de voyage sans compromis...</p>

            <div class="grid md:grid-cols-2 gap-12 mb-16">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Nos valeurs</h3>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Transparence totale</li>
                        <li>Service personnalisé</li>
                        <li>Innovation constante</li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-semibold mb-4">Notre équipe</h3>
                    <p>Une équipe passionnée de voyageurs expérimentés</p>
                </div>
            </div>

            <div class="bg-indigo-50 p-8 rounded-xl">
                <h2 class="text-2xl font-bold mb-4">Pourquoi nous choisir ?</h2>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-indigo-600 text-white p-2 rounded-lg mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p>Garantie des meilleurs prix</p>
                    </div>
                    <!-- Ajouter d'autres avantages -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection