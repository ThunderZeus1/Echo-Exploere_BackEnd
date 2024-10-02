<x-guest-layout>
    <style>
        /* Ensure the background is loaded */
        body {
            background: url('https://www.transparenttextures.com/patterns/asfalt-light.png'), linear-gradient(180deg, rgba(0, 32, 63, 1), rgba(173, 239, 209, 1));
            background-size: cover; /* Ensures the background image covers the screen */
            background-attachment: fixed; /* Ensures the background stays in place */
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        /* Wave-Shape Background */
        .wave-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 300px; /* Larger height for more prominence */
            background: inherit; /* Uses the same background as the body */
            clip-path: ellipse(100% 100% at 50% 0%);
            z-index: -1;
        }

        /* Card Animation */
        .card-container {
            animation: fadeIn 1s ease-in-out;
            position: relative;
            z-index: 1;
        }

        /* Smooth Fade-In Animation */
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Card Styling */
        .x-authentication-card {
            background: rgba(255, 255, 255, 0.9); /* Glass effect for the card */
            backdrop-filter: blur(15px);
            padding: 60px 40px;
            border-radius: 25px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            margin: 40px; /* Improved margin for spacing */
        }

        /* Logo Styling */
        .x-slot-logo img {
            width: 150px;
            height: auto;
            margin-bottom: 30px; /* Space between logo and form */
        }

        /* Input Field Customization */
        .block.mt-1.w-full {
            padding: 16px; /* Larger padding for input fields */
            font-size: 1.1rem; /* Larger text size */
            border-radius: 12px; /* More rounded corners */
            border: 2px solid rgba(0, 32, 63, 0.2);
            background-color: rgba(255, 255, 255, 0.8);
            transition: border-color 0.3s ease, background-color 0.3s ease;
        }

        .block.mt-1.w-full:focus {
            outline: none;
            border-color: #ADEFD1;
            background-color: rgba(255, 255, 255, 1);
            box-shadow: 0 0 8px rgba(173, 239, 209, 0.3);
        }

        /* Button Styling */
        .ms-4 {
            background: linear-gradient(135deg, #0078A0, #004F6B);
            color: #fff;
            padding: 14px 20px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .ms-4:hover {
            background: linear-gradient(135deg, #004F6B, #00203F);
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design for Mobile Screens */
        @media (max-width: 600px) {
            .x-authentication-card {
                padding: 40px 20px;
                width: 95%;
            }

            .x-slot-logo img {
                width: 120px;
            }
        }
    </style>

    <!-- Wave Background Container -->
    <div class="wave-container"></div>

    <div class="card-container">
        <x-authentication-card>
            <x-slot name="logo">
                <img src="{{ asset('logo/Screenshot_2024-06-09_132635-removebg-preview.png') }}" alt="Logo">
            </x-slot>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name Field -->
                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <!-- Email Field -->
                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <!-- Password Field -->
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <!-- Confirm Password Field -->
                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
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

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ms-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </x-authentication-card>
    </div>
</x-guest-layout>
