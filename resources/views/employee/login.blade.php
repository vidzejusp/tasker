<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('employee.auth') }}">
            @csrf
            <div class="mt-4">
                <x-jet-label for="passcode" value="{{ __('PIN kodas') }}" />
                <x-jet-input id="passcode" class="block mt-1 w-full" type="password" name="passcode" required autofocus />
            </div>


            <div class="flex items-center justify-center mt-4">
                <x-jet-button class="w-full justify-center">
                    {{ __('Prisijungti') }}
                </x-jet-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                <div class="flex items-center justify-center mt-4">
                        {{ __('Atjungti vartotoją') }}
                </div>
            </a>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
