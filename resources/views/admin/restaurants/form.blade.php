@props(['restaurant' => null, 'cuisineTypes', 'days', 'timeOptions'])

<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Nom -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="name" value="{{ old('name', $restaurant->name ?? '') }}" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" required>
        </div>

        <!-- Type de cuisine -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Type de cuisine</label>
            <select name="cuisine_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" required>
                @foreach($cuisineTypes as $type)
                    <option value="{{ $type }}" {{ old('cuisine_type', $restaurant->cuisine_type ?? '') == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <!-- Adresse -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Adresse</label>
            <textarea name="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" rows="3" required>{{ old('address', $restaurant->address ?? '') }}</textarea>
        </div>

        <!-- Téléphone -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Téléphone</label>
            <input type="tel" name="phone" value="{{ old('phone', $restaurant->phone ?? '') }}" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" required>
        </div>

        <!-- Note -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Note</label>
            <input type="number" name="rating" step="0.1" min="0" max="5" 
                   value="{{ old('rating', $restaurant->rating ?? 0) }}" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500" required>
        </div>

        <!-- Horaires -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Horaires d'ouverture</label>
            <div class="space-y-4" id="opening-hours-container">
                @foreach(old('opening_hours', $restaurant->opening_hours ?? [[]]) as $index => $hours)
                <div class="grid grid-cols-4 gap-4 items-center">
                    <select name="opening_hours[{{ $index }}][day]" class="rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        @foreach($days as $day)
                            <option value="{{ $day }}" {{ ($hours['day'] ?? '') == $day ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                    <select name="opening_hours[{{ $index }}][open]" class="rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        @foreach($timeOptions as $time)
                            <option value="{{ $time }}" {{ ($hours['open'] ?? '') == $time ? 'selected' : '' }}>{{ $time }}</option>
                        @endforeach
                    </select>
                    <select name="opening_hours[{{ $index }}][close]" class="rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                        @foreach($timeOptions as $time)
                            <option value="{{ $time }}" {{ ($hours['close'] ?? '') == $time ? 'selected' : '' }}>{{ $time }}</option>
                        @endforeach
                    </select>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addOpeningHour()" class="mt-4 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-md">
                <i class="fas fa-plus mr-2"></i>Ajouter un horaire
            </button>
        </div>

        <!-- Images -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Images</label>
            <input type="file" name="images[]" multiple accept="image/*" 
                   class="mt-1 block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
        </div>
    </div>
</div>

@push('scripts')
<script>
function addOpeningHour() {
    const container = document.getElementById('opening-hours-container');
    const index = container.children.length;
    
    const html = `
    <div class="grid grid-cols-4 gap-4 items-center mb-4">
        <select name="opening_hours[${index}][day]" class="rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            @foreach($days as $day)
                <option value="{{ $day }}">{{ $day }}</option>
            @endforeach
        </select>
        <select name="opening_hours[${index}][open]" class="rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            @foreach($timeOptions as $time)
                <option value="{{ $time }}">{{ $time }}</option>
            @endforeach
        </select>
        <select name="opening_hours[${index}][close]" class="rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
            @foreach($timeOptions as $time)
                <option value="{{ $time }}">{{ $time }}</option>
            @endforeach
        </select>
        <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">
            <i class="fas fa-times"></i>
        </button>
    </div>`;
    
    container.insertAdjacentHTML('beforeend', html);
}
</script>
@endpush.