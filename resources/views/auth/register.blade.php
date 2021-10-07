<x-guest-layout>
    <script src="{{ asset('js/helpers/form.js') }}"></script>
    <script src="{{ asset('js/handlers/pages/auth/register.js') }}"></script>
    
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <form id="registration" action="{{ route('register') }}" method="post"  validationUrl="{{ route('register.validate') }}">
            @csrf

            <!-- Login -->
            <div>
                <x-label for="login" :value="__('Login')" />
                <x-input id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" placeholder="Johnny" required autofocus />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" placeholder="+380000000000" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="johnny@example.com" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4" type="button" onclick="handleRegistration()">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
    
</x-guest-layout>
