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
    <form method="POST" action="{{ route('login') }}" class="form-container">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label  class='auth_form_label' for="email" :value="__('Email')" />
            <x-text-input id="email" class="input-field" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="error-message" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label  class='auth_form_label' for="password" :value="__('Password')" />
            <x-text-input id="password" class="input-field" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="error-message" />
        </div>

        <!-- Remember Me -->
        <div class="form-group">
            <label class='auth_form_label' for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="checkbox" name="remember">
                <span class="checkbox-label">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Links and Buttons -->
        <div class="form-footer">
        <div class="text-center mt-4">
        <span class="text-white">Don't have an account? </span>
        <a href="{{ route('register') }}" class="register-link">Register Here</a>
        </div>
            <x-primary-button class="auth_submit_btn">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
