<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Contactez-nous</h2>
        
        <form method="POST" action="{{ route('contact.submit') }}" class="space-y-4">
            @csrf

            <div class="grid gap-4 md:grid-cols-2">
                <!-- Nom -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <input 
                        type="text" 
                        name="name" 
                        required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}"
                    >
                    @error('name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        required
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Message -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Message</label>
                <textarea 
                    name="message" 
                    rows="4" 
                    required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('message') border-red-500 @enderror"
                >{{ old('message') }}</textarea>
                @error('message')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Bouton -->
            <div class="mt-6">
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors"
                >
                    Envoyer
                </button>
            </div>
        </form>
    </div>
</div>