<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $cruise->cruise_line }} - {{ $cruise->itinerary }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">{{ __('Cruise Details') }}</h3>
                            <div class="space-y-2">
                                <p><strong>{{ __('Departure Date') }}:</strong> 
                                    {{ $cruise->start_date->format('F j, Y') }}</p>
                                <p><strong>{{ __('Return Date') }}:</strong> 
                                    {{ $cruise->end_date->format('F j, Y') }}</p>
                                <p><strong>{{ __('Ports of Call') }}:</strong> 
                                    {{ $cruise->ports_count }} ports</p>
                                <p><strong>{{ __('Price') }}:</strong> 
                                    {{ number_format($cruise->price, 2) }} €</p>
                            </div>
                            
                            <h3 class="text-lg font-semibold mt-6 mb-4">{{ __('Cabins Available') }}</h3>
                            <div class="space-y-4">
                                @foreach($cruise->cabins as $cabin)
                                <div class="border p-4 rounded-lg">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-semibold">{{ $cabin->type }}</p>
                                            <p class="text-sm text-gray-500">{{ $cabin->description }}</p>
                                        </div>
                                        <span class="text-lg font-bold">
                                            {{ number_format($cabin->price, 2) }} €
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg">
                            @include('cruises.partials.booking-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>