<x-guest-layout>
    <style>
        /* Effet lightning amélioré */
        .form-container {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            width: 700px; /* Doubled width for the form */
            margin-left: 50%; /* Align to the left edge of the screen */
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
    </style>

    <div class="min-h-screen flex items-center justify-start bg-cover bg-center bg-no-repeat bg-fixed" style="background-image: url('https://res.cloudinary.com/zublu/image/fetch/f_webp,w_1200,q_auto/https://www.zubludiving.com/images/Indonesia/Bali/Bali-Indonesia-Banner.jpg');">
        <!-- Conteneur principal -->
        <div class="form-container border-gradient h-[900px] bg-white bg-opacity-90 rounded-xl shadow-lg p-8 relative">
            <!-- Bordures décoratives -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-blue-500 to-purple-500"></div>
            <div class="absolute top-0 left-0 h-full w-2 bg-gradient-to-b from-blue-500 to-purple-500"></div>
            <div class="absolute top-0 right-0 h-full w-2 bg-gradient-to-b from-blue-500 to-purple-500"></div>
            
            <!-- Contenu -->
            <div class="h-full flex flex-col relative z-10">
                <!-- En-tête -->
                <div class="flex flex-col items-center mb-6">
                    <svg class="w-16 h-16 mb-4 text-blue-500 hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    <h1 class="text-3xl font-bold text-gray-800">JetStream Voyages</h1>
                    <p class="text-gray-500 mt-2">Créez un compte pour commencer votre aventure</p>
                </div>

                <x-validation-errors class="mb-4" />
                
                <form method="POST" action="{{ route('register') }}" class="flex-1 flex flex-col space-y-4">
                    @csrf

                    <!-- Nom -->
                    <div>
                        <x-label for="name" class="block text-sm font-medium text-gray-700 mb-1" value="{{ __('Name') }}" />
                        <x-input id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" 
                                 type="text" name="name" :value="old('name')" required autofocus placeholder="Votre nom" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-label for="email" class="block text-sm font-medium text-gray-700 mb-1" value="{{ __('Email') }}" />
                        <x-input id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" 
                                 type="email" name="email" :value="old('email')" required placeholder="votre@email.com" />
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <x-label for="password" class="block text-sm font-medium text-gray-700 mb-1" value="{{ __('Password') }}" />
                        <x-input id="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" 
                                 type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                    </div>

                    <!-- Confirmation Mot de passe -->
                    <div>
                        <x-label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500" 
                                 type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmez le mot de passe" />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />

                                    <div class="ms-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif

                    <!-- Espaceur -->
                    <div class="flex-1"></div>

                    <!-- Bouton de soumission -->
                    <div>
                        <x-button class="w-full items-center justify-center bg-gradient-to-r from-purple-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white py-2.5 rounded-md font-semibold transition-all duration-300">
                            {{ __("S'INSCRIRE") }}
                        </x-button>
                    </div>
                </form>

                <!-- Lien de connexion -->
                <div class="text-center text-sm text-gray-600 mt-4">
                    {{ __("Already registered?") }}
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-600 font-medium hover:underline">
                        {{ __('Log in') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>