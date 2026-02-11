<x-guest-layout>
    <style>
        /* Effet lightning amélioré */
        .form-container {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        .form-container:hover {
            box-shadow: 0 0 20px 8px rgba(59, 130, 246, 0.5);
        }
        
        @keyframes lightningFlash {
            0% { opacity: 0; transform: rotate(30deg) translate(-30%, -30%); }
            20% { opacity: 0.8; }
            40% { opacity: 0.3; }
            60% { opacity: 0.9; }
            100% { opacity: 0; transform: rotate(30deg) translate(30%, 30%); }
        }
        
        /* Bordures gradient */
        .border-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 2px solid transparent;
            border-radius: 0.75rem;
            background: linear-gradient(45deg, #3B82F6, #8B5CF6) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: destination-out;
            mask-composite: exclude;
            pointer-events: none;
        }
        #cnx {
            background-color: #6D28D9;
            border-radius: 1rem;
            border: 2px solid transparent;
            transition: background-color 0.2s ease, transform 0.2s ease;
            margin-left: 10px;
        }
        #cnx {
            background-color: #A78BFA;
            transform: scale(1.05);
        }
    </style>

    <div class="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat bg-fixed" style="background-image: url('https://img.freepik.com/free-photo/single-tree-desert-with-beautiful-cloudy-sky-sunset_181624-2852.jpg?t=st=1744151746~exp=1744155346~hmac=7f7a505543774eefaed23a32efa90b5b4f3944a1db4478b18e1873a4289fbea3&w=1380');">
        <!-- Conteneur principal - Taille réduite -->
        <div class="form-container border-gradient w-[380px] h-[580px] bg-white bg-opacity-90 rounded-xl shadow-lg p-6 relative">
            <!-- Bordures décoratives -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-blue-500 to-purple-500"></div>
            <div class="absolute top-0 left-0 h-full w-2 bg-gradient-to-b from-blue-500 to-purple-500"></div>
            <div class="absolute top-0 right-0 h-full w-2 bg-gradient-to-b from-blue-500 to-purple-500"></div>
            
            <!-- Contenu -->
            <div class="h-full flex flex-col relative z-10">
                <!-- En-tête -->
                <div class="flex flex-col items-center mb-4">
                    <svg class="w-12 h-12 mb-2 text-blue-500 hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <h1 class="text-2xl font-bold text-gray-800">JetStream Voyages</h1>
                    <p class="text-gray-500 text-sm mt-1">Vivez une aventure exceptionnelle</p>
                </div>

                <x-validation-errors class="mb-3" />
                
                @if (session('status'))
                    <div class="mb-3 font-medium text-sm text-green-500 text-center">
                        {{ session('status') }}
                    </div>
                @endif
                
                <!-- Formulaire -->
                <form method="POST" action="{{ route('login') }}" class="flex-1 flex flex-col space-y-3">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <x-label for="email" class="block text-sm font-medium text-gray-700 mb-1" value="{{ __('Email') }}" />
                        <x-input id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 text-sm" 
                                 type="email" name="email" :value="old('email')" required autofocus placeholder="votre@email.com" />
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <x-label for="password" class="block text-sm font-medium text-gray-700 mb-1" value="{{ __('Password') }}" />
                        <div class="relative">
                            <x-input id="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 text-sm" 
                                     type="password" name="password" required placeholder="••••••••" />
                        </div>
                    </div>

                    <!-- Se souvenir de moi -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center text-xs text-gray-600">
                            <x-checkbox id="remember_me" name="remember" class="mr-2 border-gray-300" />
                            {{ __('Remember me') }}
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-xs text-blue-500 hover:text-blue-600 hover:underline" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Espaceur -->
                    <div class="flex-1"></div>

                    <!-- Bouton de connexion -->
                    <div>
                        <x-button class="w-full items-center justify-center bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white py-2 rounded-md font-semibold text-sm transition-all duration-300">
                            {{ __('CONNEXION') }}
                        </x-button>
                    </div>
                </form>

                <!-- Lien d'inscription -->
                <div class="text-center text-xs text-gray-600 mt-3">
                    {{ __("Pas de compte ?") }}
                    <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-600 font-medium hover:underline">
                        {{ __('S\'inscrire') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>