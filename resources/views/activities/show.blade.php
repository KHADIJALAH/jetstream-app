<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $activity->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">{{ __('Activity Details') }}</h3>
                            <p class="mb-2"><strong>{{ __('Location') }}:</strong> {{ $activity->location }}</p>
                            <p class="mb-2"><strong>{{ __('Duration') }}:</strong> {{ $activity->duration }} hours</p>
                            <p class="mb-2"><strong>{{ __('Price') }}:</strong> {{ number_format($activity->price, 2) }} €</p>
                            <p class="mt-4">{{ $activity->description }}</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">{{ __('Book This Activity') }}</h3>
                            <form method="POST" action="{{ route('activities.book', $activity) }}">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="participants" :value="__('Number of Participants')" />
                                        <x-text-input id="participants" type="number" min="1" max="10" name="participants" required />
                                    </div>
                                    
                                    <div>
                                        <x-input-label for="date" :value="__('Preferred Date')" />
                                        <x-text-input id="date" type="date" name="date" required />
                                    </div>

                                    <x-primary-button class="w-full justify-center">
                                        {{ __('Book Now') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="mt-8 flex space-x-4">
                        @can('update', $activity)
                        <a href="{{ route('activities.edit', $activity) }}" 
                           class="bg-blue-500 text-white px-4 py-2 rounded">
                            {{ __('Edit') }}
                        </a>
                        @endcan

                        @can('delete', $activity)
                        <form method="POST" action="{{ route('activities.destroy', $activity) }}">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 text-white px-4 py-2 rounded"
                                    onclick="return confirm('{{ __('Are you sure?') }}')">
                                {{ __('Delete') }}
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>