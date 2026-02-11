<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $restaurant->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Restaurant Info -->
                        <div>
                            <div class="flex items-center mb-4">
                                <span class="text-2xl mr-2">
                                    @for($i = 0; $i < $restaurant->price_range; $i++)
                                    €
                                    @endfor
                                </span>
                                <span class="text-sm text-gray-500">
                                    ({{ $restaurant->cuisine_type }})
                                </span>
                            </div>

                            <div class="space-y-2">
                                <p><strong>{{ __('Address') }}:</strong> {{ $restaurant->address }}</p>
                                <p><strong>{{ __('Opening Hours') }}:</strong> {{ $restaurant->opening_hours }}</p>
                                <p><strong>{{ __('Phone') }}:</strong> {{ $restaurant->phone }}</p>
                                @if($restaurant->website)
                                <p><strong>{{ __('Website') }}:</strong> 
                                    <a href="{{ $restaurant->website }}" class="text-blue-500" target="_blank">
                                        {{ parse_url($restaurant->website, PHP_URL_HOST) }}
                                    </a>
                                </p>
                                @endif
                            </div>

                            <hr class="my-6">

                            <h3 class="text-lg font-semibold mb-4">{{ __('Description') }}</h3>
                            <p class="text-gray-600">{{ $restaurant->description }}</p>
                        </div>

                        <!-- Reservations & Reviews -->
                        <div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold mb-4">{{ __('Make Reservation') }}</h3>
                                @include('restaurants.partials.reservation-form')
                            </div>

                            <div class="mt-6">
                                <h3 class="text-lg font-semibold mb-4">{{ __('Reviews') }}</h3>
                                <div class="space-y-4">
                                    @foreach($restaurant->reviews as $review)
                                    <div class="border p-4 rounded">
                                        <div class="flex items-center mb-2">
                                            <div class="flex-1">
                                                <strong>{{ $review->user->name }}</strong>
                                                <div class="flex items-center mt-1">
                                                    @for($i = 0; $i < $review->rating; $i++)
                                                    ⭐
                                                    @endfor
                                                </div>
                                            </div>
                                            <span class="text-sm text-gray-500">
                                                {{ $review->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p>{{ $review->comment }}</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>