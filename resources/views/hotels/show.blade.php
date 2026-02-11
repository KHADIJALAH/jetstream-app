<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hotel Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-2">{{ $hotel->name }}</h3>
                    <p class="mb-4">{{ $hotel->description }}</p>
                    <p>{{ __('Address:') }} {{ $hotel->address }}, {{ $hotel->city }}, {{ $hotel->country }}</p>
                    
                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div>
                            <p class="font-medium">{{ __('Star Rating') }}: 
                                @for($i = 0; $i < $hotel->star_rating; $i++)
                                    ⭐
                                @endfor
                            </p>
                            <p class="font-medium">{{ __('Price per Night') }}: 
                                {{ number_format($hotel->price_per_night, 2) }} €</p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500">{{ __('Created at') }}: 
                                {{ $hotel->created_at->format('d/m/Y H:i') }}</p>
                            <p class="text-sm text-gray-500">{{ __('Last update') }}: 
                                {{ $hotel->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="mt-8 flex space-x-4">
                        @can('update', $hotel)
                            <a href="{{ route('hotels.edit', $hotel) }}" 
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Edit Hotel') }}
                            </a>
                        @endcan

                        @can('delete', $hotel)
                            <form action="{{ route('hotels.destroy', $hotel) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        onclick="return confirm('{{ __("Are you sure you want to delete this hotel?") }}')">
                                    {{ __('Delete Hotel') }}
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>

            <!-- Bouton de retour -->
            <div class="mt-6">
                <a href="{{ route('hotels.index') }}" 
                   class="text-indigo-600 hover:text-indigo-900">
                    ← {{ __('Back to Hotels List') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Section des messages de succès/erreur -->
    @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
            {{ session('error') }}
        </div>
    @endif
</x-app-layout>