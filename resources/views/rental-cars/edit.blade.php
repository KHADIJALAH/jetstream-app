<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Rental Car') }}: {{ $car->car_model }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('rental-cars.update', $car) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Car Model -->
                            <div>
                                <x-input-label for="car_model" :value="__('Car Model')" />
                                <x-text-input id="car_model" class="block mt-1 w-full" 
                                    type="text" name="car_model" :value="old('car_model', $car->car_model)" required />
                            </div>

                            <!-- Car Type -->
                            <div>
                                <x-input-label for="car_type" :value="__('Car Type')" />
                                <select id="car_type" name="car_type" class="block mt-1 w-full rounded-md">
                                    <option value="sedan" {{ $car->car_type === 'sedan' ? 'selected' : '' }}>Sedan</option>
                                    <option value="suv" {{ $car->car_type === 'suv' ? 'selected' : '' }}>SUV</option>
                                    <option value="van" {{ $car->car_type === 'van' ? 'selected' : '' }}>Van</option>
                                </select>
                            </div>

                            <!-- Pricing -->
                            <div>
                                <x-input-label for="daily_price" :value="__('Daily Price')" />
                                <x-text-input id="daily_price" class="block mt-1 w-full"
                                    type="number" step="0.01" name="daily_price" 
                                    :value="old('daily_price', $car->daily_price)" required />
                            </div>

                            <!-- Availability -->
                            <div>
                                <x-input-label for="available" :value="__('Availability')" />
                                <select id="available" name="available" class="block mt-1 w-full rounded-md">
                                    <option value="1" {{ $car->available ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ !$car->available ? 'selected' : '' }}>Not Available</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Update Car Details') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>