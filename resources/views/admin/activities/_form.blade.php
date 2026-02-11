@php
    $isEdit = isset($activity);
@endphp

<div class="space-y-4">
    <h3 class="text-lg font-semibold text-gray-700 mb-2">Informations de base</h3>

    <div class="grid grid-cols-1 gap-4">
        <!-- Nom -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nom de l'activité</label>
            <input type="text" id="name" name="name" value="{{ old('name', $activity->name ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                         focus:border-violet-500 focus:ring-violet-500" required autofocus>
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Catégorie -->
        <div>
            <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
            <select id="category" name="category"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                          focus:border-violet-500 focus:ring-violet-500" required>
                @foreach(config('activity_categories') as $key => $value)
                    <option value="{{ $key }}" {{ old('category', $activity->category ?? '') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            @error('category') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="4"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                            focus:border-violet-500 focus:ring-violet-500">{{ old('description', $activity->description ?? '') }}</textarea>
            @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>
</div>

<div class="space-y-4 pt-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-2">Détails</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Prix -->
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Prix (€)</label>
            <input type="number" id="price" name="price" value="{{ old('price', $activity->price ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                         focus:border-violet-500 focus:ring-violet-500" min="0" step="0.01" required>
            @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Durée -->
        <div>
            <label for="duration" class="block text-sm font-medium text-gray-700">Durée (heures)</label>
            <input type="number" id="duration" name="duration" value="{{ old('duration', $activity->duration ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                         focus:border-violet-500 focus:ring-violet-500" min="1" required>
            @error('duration') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Localisation -->
        <div class="md:col-span-2">
            <label for="location" class="block text-sm font-medium text-gray-700">Localisation</label>
            <input type="text" id="location" name="location" value="{{ old('location', $activity->location ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                         focus:border-violet-500 focus:ring-violet-500" required>
            @error('location') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>
</div>

<div class="space-y-4 pt-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-2">Image</h3>

    <div class="grid grid-cols-1 gap-4">
        @if($isEdit && $activity->hasMedia('activities'))
            <div>
                <span class="block text-sm font-medium text-gray-700 mb-2">Image actuelle :</span>
                <img src="{{ $activity->getFirstMediaUrl('activities') }}" alt="Image de l'activité"
                     class="h-32 w-auto rounded-lg shadow-sm object-cover">
            </div>
        @endif

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">
                {{ $isEdit && $activity->hasMedia('activities') ? 'Changer l\'image' : 'Image principale' }}
            </label>
            <input type="file" id="image" name="image"
                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                         file:rounded-full file:border-0 file:bg-violet-50 file:text-violet-700
                         hover:file:bg-violet-100">
            @error('image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>
</div>

<div class="pt-6">
    <button type="submit"
            class="w-full flex justify-center items-center px-6 py-3 border border-transparent 
                  rounded-md shadow-sm text-white bg-violet-600 hover:bg-violet-700 
                  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500
                  transition">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="{{ $isEdit ? 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15' : 'M12 6v6m0 0v6m0-6h6m-6 0H6' }}" />
        </svg>
        {{ $submitText }}
    </button>
</div>