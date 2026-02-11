<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vacation Rentals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Filters -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <x-input-label for="property_type" :value="__('Property Type')" />
                                <select id="property_type" name="property_type" class="block mt-1 w-full rounded-md">
                                    <option value="">{{ __('All Types') }}</option>
                                    <option value="house">House</option>
                                    <option value="apartment">Apartment</option>
                                    <option value="villa">Villa</option>
                                </select>
                            </div>
                            
                            <div>
                                <x-input-label for="bedrooms" :value="__('Bedrooms')" />
                                <x-text-input id="bedrooms" type="number" min="1" name="bedrooms" />
                            </div>

                            <div>
                                <x-input-label for="min_price" :value="__('Min Price')" />
                                <x-text-input id="min_price" type="number" name="min_price" />
                            </div>

                            <div class="self-end">
                                <x-primary-button class="w-full">
                                    {{ __('Apply Filters') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                    <!-- Rentals Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($rentals as $rental)
                            <div class="border rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                                <img src="{{ $rental->main_image }}" alt="Property image" class="w-full h-48 object-cover">
                                
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg">{{ $rental->title }}</h3>
                                    <p class="text-gray-600 mt-2">{{ $rental->location }}</p>
                                    
                                    <div class="mt-4 flex items-center justify-between">
                                        <span class="text-xl font-bold text-blue-600">
                                            {{ number_format($rental->price_per_night, 2) }} €/night
                                        </span>
                                        <a href="{{ route('rentals.show', $rental) }}" 
                                           class="text-indigo-600 hover:text-indigo-900">
                                            {{ __('View') }} →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $rentals->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>