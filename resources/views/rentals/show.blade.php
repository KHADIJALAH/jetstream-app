<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $rental->property_type }} in {{ $rental->location }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Gallery -->
                        <div class="lg:col-span-2">
                            <img src="{{ $rental->featured_image }}" alt="Property image" class="rounded-lg w-full h-64 object-cover">
                            <div class="grid grid-cols-3 gap-2 mt-4">
                                @foreach($rental->images as $image)
                                <img src="{{ $image }}" class="h-24 w-full object-cover rounded">
                                @endforeach
                            </div>
                        </div>

                        <!-- Details -->
                        <div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-2xl font-bold text-blue-600 mb-4">
                                    {{ number_format($rental->price_per_night, 2) }} €/night
                                </p>
                                
                                <div class="space-y-2">
                                    <p><strong>{{ __('Bedrooms') }}:</strong> {{ $rental->bedrooms }}</p>
                                    <p><strong>{{ __('Bathrooms') }}:</strong> {{ $rental->bathrooms }}</p>
                                    <p><strong>{{ __('Max Guests') }}:</strong> {{ $rental->max_guests }}</p>
                                </div>

                                <hr class="my-4">

                                <h4 class="font-semibold mb-2">{{ __('Amenities') }}</h4>
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach(json_decode($rental->amenities) as $amenity)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                        {{ $amenity }}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                        @include('rentals.partials.booking-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>