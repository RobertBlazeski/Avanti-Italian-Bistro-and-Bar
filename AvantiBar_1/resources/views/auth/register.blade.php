
<x-guest-layout>
    <!-- Add Avanti Logo -->
    <div class="logo-container">
    <a href="/">
            <img 
                src="{{ asset('Images/Logos/Avanti_logo_1.png') }}" 
                alt="Avanti Logo">
        </a>
    </div>
    <link rel="stylesheet" href="{{ asset('css/spec_styles.css') }}">

    <!-- Login Form -->
    <form method="POST" action="{{ route('register') }}" class="form-container">
        @csrf

         <!-- Name -->
         <div>
            <x-input-label class='auth_form_label' for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label  class='auth_form_label' for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label  class='auth_form_label' for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label class='auth_form_label' for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center justify-between mt-4">
            <span class="text-white">Already have an account? </span>
            <a href="{{ route('login') }}" class="register-link">Login Here</a>
            </div>
            <x-primary-button class="auth_submit_btn2">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

