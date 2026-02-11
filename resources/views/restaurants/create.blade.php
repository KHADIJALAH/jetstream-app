<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Restaurant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('restaurants.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Info -->
                            <div>
                                <x-input-label for="name" :value="__('Restaurant Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" 
                                    type="text" name="name" required />
                            </div>

                            <div>
                                <x-input-label for="cuisine_type" :value="__('Cuisine Type')" />
                                <x-text-input id="cuisine_type" class="block mt-1 w-full"
                                    type="text" name="cuisine_type" required />
                            </div>

                            <!-- Price Range -->
                            <div>
                                <x-input-label for="price_range" :value="__('Price Range')" />
                                <select id="price_range" name="price_range" class="block mt-1 w-full rounded-md">
                                    <option value="$">$ - Budget</option>
                                    <option value="$$">$$ - Moderate</option>
                                    <option value="$$$">$$$ - Expensive</option>
                                    <option value="$$$$">$$$$ - Luxury</option>
                                </select>
                            </div>

                            <!-- Contact Info -->
                            <div>
                                <x-input-label for="phone" :value="__('Phone Number')" />
                                <x-text-input id="phone" class="block mt-1 w-full"
                                    type="tel" name="phone" required />
                            </div>

                            <!-- Hours & Website -->
                            <div class="md:col-span-2">
                                <x-input-label for="opening_hours" :value="__('Opening Hours')" />
                                <x-text-input id="opening_hours" class="block mt-1 w-full"
                                    type="text" name="opening_hours" 
                                    placeholder="ex: 08:00 AM - 10:00 PM" required />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="website" :value="__('Website')" />