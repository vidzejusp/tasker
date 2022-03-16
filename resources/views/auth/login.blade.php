<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img class="block h-28 w-auto" src="{{ asset('images/logo.png') }}" />
{{--            <x-jet-authentication-card-logo />--}}
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="w-full mb-4 py-2 font-semibold text-sm text-red-600 text-center tracking-wider uppercase">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="company" value="{{ __('Įmonės unikalus numeris') }}" />
                <x-jet-input id="company" class="block mt-1 w-full" type="number" name="company" :value="old('company')" min="1000" max="9999" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="username" value="{{ __('Vartotojo vardas') }}" />
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" checked />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Prisiminti mane') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Prisijungti') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
