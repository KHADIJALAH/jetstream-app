@extends('layouts.app')

@section('content')
    @if(auth()->user()->is_admin)
        <div class="min-h-screen bg-gray-100 p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <!-- En-tête -->
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-800">Tableau de bord Admin</h1>
                        <p class="text-gray-600 mt-1 text-lg">Gestion complète de votre application</p>
                    </div>
                    <div class="bg-blue-200 px-4 py-3 rounded-lg border border-blue-300 shadow-sm">
                        <p class="text-blue-600 font-semibold">Bienvenue <span class="font-bold">{{ auth()->user()->name }}</span> 👋</p>
                    </div>
                </div>

                <!-- Statistiques principales - Cartes carrées -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                    <div class="bg-gradient-to-br from-blue-200 to-blue-300 p-6 rounded-lg border border-blue-400 shadow-lg hover:shadow-xl transition-shadow hover:scale-105">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-blue-700 font-medium text-sm uppercase tracking-wider">Services</p>
                                <p class="text-4xl font-bold mt-2 text-gray-800">42</p>
                            </div>
                            <span class="bg-blue-300 text-blue-700 p-4 rounded-lg shadow-md">🏗️</span>
                        </div>
                        <div class="mt-5 pt-3 border-t border-blue-400">
                            <p class="text-xs text-blue-600">+5% ce mois</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-green-200 to-green-300 p-6 rounded-lg border border-green-400 shadow-lg hover:shadow-xl transition-shadow hover:scale-105">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-green-700 font-medium text-sm uppercase tracking-wider">Réservations</p>
                                <p class="text-4xl font-bold mt-2 text-gray-800">128</p>
                            </div>
                            <span class="bg-green-300 text-green-700 p-4 rounded-lg shadow-md">📅</span>
                        </div>
                        <div class="mt-5 pt-3 border-t border-green-400">
                            <p class="text-xs text-green-600">+12% ce mois</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-200 to-purple-300 p-6 rounded-lg border border-purple-400 shadow-lg hover:shadow-xl transition-shadow hover:scale-105">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-purple-700 font-medium text-sm uppercase tracking-wider">Utilisateurs</p>
                                <p class="text-4xl font-bold mt-2 text-gray-800">76</p>
                            </div>
                            <span class="bg-purple-300 text-purple-700 p-4 rounded-lg shadow-md">👥</span>
                        </div>
                        <div class="mt-5 pt-3 border-t border-purple-400">
                            <p class="text-xs text-purple-600">+8 nouveaux</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-amber-200 to-amber-300 p-6 rounded-lg border border-amber-400 shadow-lg hover:shadow-xl transition-shadow hover:scale-105">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-amber-700 font-medium text-sm uppercase tracking-wider">Avis</p>
                                <p class="text-4xl font-bold mt-2 text-gray-800">94</p>
                            </div>
                            <span class="bg-amber-300 text-amber-700 p-4 rounded-lg shadow-md">⭐</span>
                        </div>
                        <div class="mt-5 pt-3 border-t border-amber-400">
                            <p class="text-xs text-amber-600">Moy. 4.5/5</p>
                        </div>
                    </div>
                </div>

                <!-- Graphiques -->
                <div class="mb-10">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Statistiques</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Graphique des réservations -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <canvas id="reservationsChart"></canvas>
                        </div>

                        <!-- Graphique des utilisateurs -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <canvas id="usersChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Menu de gestion -->
                <div class="mb-10">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Menu de gestion</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
                        @foreach ([
                            ['Services', 'Gérer l\'ensemble des services proposés', '🏗️', 'bg-blue-100', 'text-blue-600'],
                            ['Réservations', 'Visualiser et gérer les réservations', '📅', 'bg-green-100', 'text-green-600'],
                            ['Utilisateurs', 'Gérer les comptes utilisateurs', '👥', 'bg-purple-100', 'text-purple-600'],
                            ['Avis', 'Modérer les avis des clients', '⭐', 'bg-amber-100', 'text-amber-600'],
                        ] as [$title, $description, $icon, $bgColor, $textColor])
                            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm hover:shadow-lg transition-shadow h-32 flex flex-col justify-between hover:bg-gray-100">
                                <div>
                                    <div class="{{ $bgColor }} w-10 h-10 rounded-md flex items-center justify-center mb-4">
                                        <span class="{{ $textColor }} text-2xl">{{ $icon }}</span>
                                    </div>
                                    <h3 class="font-semibold text-lg text-gray-800">{{ $title }}</h3>
                                    <p class="text-gray-500 text-sm">{{ $description }}</p>
                                </div>
                                <a href="#" class="mt-2 inline-block {{ $bgColor }} {{ $textColor }} text-center py-2 rounded-lg font-medium hover:bg-opacity-80">Accéder</a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Dernières activités -->
                <div class="bg-white p-6 rounded-lg border border-gray-200 mb-8 shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex justify-between items-center mb-5">
                        <h2 class="text-2xl font-semibold text-gray-800">Activités récentes</h2>
                        <a href="#" class="text-sm text-blue-600 hover:underline">Voir tout</a>
                    </div>
                    <div class="space-y-4">
                        @foreach ([
                            ['Nouveau service ajouté', 'Spa Premium', 'il y a 2h', 'Par Admin', 'bg-blue-100', 'text-blue-600'],
                            ['Réservation confirmée', '#4582 - Suite Deluxe', 'il y a 5h', 'Payée', 'bg-green-100', 'text-green-600'],
                            ['Nouvel utilisateur', 'Jean Dupont', 'il y a 1j', 'Client', 'bg-purple-100', 'text-purple-600'],
                        ] as [$activity, $details, $time, $author, $iconColor, $textColor])
                            <div class="flex items-center justify-between p-5 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow hover:bg-gray-100">
                                <div class="flex items-center">
                                    <span class="{{ $iconColor }} {{ $textColor }} p-3 rounded-full mr-4">{{ $iconColor }}</span>
                                    <div>
                                        <p class="font-medium">{{ $activity }}</p>
                                        <p class="text-sm text-gray-500">{{ $details }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm text-gray-500">{{ $time }}</span>
                                    <span class="block text-xs {{ $textColor }}">{{ $author }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-md hover:shadow-lg transition-shadow">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-5">Actions rapides</h2>
                    <div class="flex flex-wrap gap-4">
                        @foreach ([
                            ['Ajouter un service', 'bg-blue-50', 'text-blue-600', '+'],
                            ['Générer un rapport', 'bg-gray-50', 'text-gray-600', '📊'],
                            ['Exporter données', 'bg-green-50', 'text-green-600', '📤'],
                            ['Paramètres', 'bg-purple-50', 'text-purple-600', '⚙️'],
                        ] as [$action, $bgColor, $textColor, $icon])
                            <button class="flex items-center px-4 py-2 {{ $bgColor }} hover:bg-opacity-80 {{ $textColor }} rounded-lg text-sm font-medium hover:shadow-md transition-shadow">
                                <span class="mr-2">{{ $icon }}</span> {{ $action }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctx1 = document.getElementById('reservationsChart').getContext('2d');
                var reservationsChart = new Chart(ctx1, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                        datasets: [{
                            label: 'Réservations',
                            data: [12, 19, 3, 5, 2, 3, 20],
                            backgroundColor: 'rgba(52, 152, 219, 0.5)',
                            borderColor: 'rgba(52, 152, 219, 1)',
                            borderWidth: 1,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                var ctx2 = document.getElementById('usersChart').getContext('2d');
                var usersChart = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                        datasets: [{
                            label: 'Utilisateurs',
                            data: [3, 10, 5, 2, 20, 30, 45],
                            backgroundColor: 'rgba(231, 76, 60, 0.5)',
                            borderColor: 'rgba(231, 76, 60, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    @endif
@endsection