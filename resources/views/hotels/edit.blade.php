<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Hotel') }}: {{ $hotel->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('hotels.update', $hotel) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Hotel Name -->
                            <div>
                                <x-input-label for="name" :value="__('Hotel Name')" />
                                <x-text-input id="name" class="block mt-1 w-full"
                                    type="text" name="name" :value="old('name', $hotel->name)" required />
                            </div>

                            <!-- Star Rating -->
                            <div>
                                <x-input-label for="star_rating" :value="__('Star Rating')" />
                                <select id="star_rating" name="star_rating" class="block mt-1 w-full rounded-md border-gray-300">
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ $hotel->star_rating == $i ? 'selected' : '' }}>
                                            {{ $i }} ⭐
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Price -->
                            <div>
                                <x-input-label for="price_per_night" :value="__('Nightly Price')" />
                                <x-text-input id="price_per_night" class="block mt-1 w-full"
                                    type="number" step="0.01" name="price_per_night" 
                                    :value="old('price_per_night', $hotel->price_per_night)" required />
                            </div>

                            <!-- Location Fields -->
                            <div>
                                <x-input-label for="city" :value="__('City')" />
                                <x-text-input id="city" class="block mt-1 w-full"
                                    type="text" name="city" :value="old('city', $hotel->city)" required />
                            </div>

                            <div>
                                <x-input-label for="country" :value="__('Country')" />
                                <x-text-input id="country" class="block mt-1 w-full"
                                    type="text" name="country" :value="old('country', $hotel->country)" required />
                            </div>

                            <!-- Description -->
                            <div class="md:col-span-2">
                                <x-input-label for="description" :value="__('Description')" />
                                <x-textarea id="description" class="block mt-1 w-full"
                                    name="description" rows="4">{{ old('description', $hotel->description) }}</x-textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Update Hotel') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>