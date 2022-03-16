<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
{{--                        <x-jet-application-mark class="block h-9 w-auto" />--}}
                            <img class="block h-14 w-auto" src="{{ asset('images/logo.png') }}" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex text-center">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Mano užduotys') }}
                    </x-jet-nav-link>
                    @can('task edit')
                        <x-jet-nav-link href="{{ route('tasks.control') }}" :active="request()->routeIs('tasks.control')">
                            {{ __('Užduočių valdymas') }}
                        </x-jet-nav-link>
                    @endcan
                    @can('notes view')
                        <x-jet-nav-link href="{{ route('notes.index') }}" :active="request()->routeIs('notes.index')">
                            {{ __('Atmintinė') }}
                        </x-jet-nav-link>
                    @endcan
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <div class="ml-3 relative">
                    @if(Auth::user()->relations()->count() == 1)
                        <div align="right" width="48">
                            <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->company->name }}
                                    </button>
                                </span>
                        </div>
                    @else
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->company->name }}
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Pasirinkite įmonę') }}
                                </div>

                                @foreach (Auth::user()->relations()->where('company_id', '!=', Auth::user()->company->id)->get() as $relation)
                                    <form method="POST" action="{{ route('switch') }}">
                                        @csrf
                                        <input type="hidden" name="company_id" value="{{ $relation->company_id }}">
                                        <x-jet-dropdown-link href="{{ route('switch') }}"
                                                             onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                            {{ $relation->company->name }}
                                        </x-jet-dropdown-link>
                                    </form>
                                @endforeach
                            </x-slot>
                        </x-jet-dropdown>
                    @endif
                </div>

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">

                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    @if(Auth::user()->employees()->exists())
                                        {{ Auth::user()->employee->name }}
                                    @else
                                        {{ Auth::user()->name }}
                                    @endif
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Nustatymai') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Vartotojo paskyra') }}
                            </x-jet-dropdown-link>
                            <div class="border-t border-gray-100"></div>

                            <!-- Company control -->
                            @role('admin')
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Įmonės valdymas') }}
                                </div>
                                <x-jet-dropdown-link href="{{ route('users') }}">
                                    {{ __('Vartotojų valdymas') }}
                                </x-jet-dropdown-link>
                                <x-jet-dropdown-link href="{{ route('users') }}">
                                    {{ __('Nustatymai') }}
                                </x-jet-dropdown-link>
                                <div class="border-t border-gray-100"></div>
                            @endrole

                            <!-- System control -->
                            @role('global_admin')
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Sistemos valdymas') }}
                            </div>
                            <x-jet-dropdown-link href="#">
                                {{ __('Įmonės') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('admin.permissions') }}">
                                {{ __('Leidimai') }}
                            </x-jet-dropdown-link>
                            <div class="border-t border-gray-100"></div>
                            @endrole

                            <!-- Authentication -->
                            @if(Auth::user()->employees()->exists() && Auth::user()->current_employee > 0)
                                <form method="POST" action="{{ route('employee.logout') }}">
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('employee.logout') }}"
                                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Atsijungti') }}
                                    </x-jet-dropdown-link>
                                </form>
                            @else
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Atsijungti') }}
                                    </x-jet-dropdown-link>
                                </form>
                            @endif
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-1 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Mano užduotys') }}
            </x-jet-responsive-nav-link>
            @can('task edit')
                <x-jet-responsive-nav-link href="{{ route('tasks.control') }}" :active="request()->routeIs('tasks.control')">
                    {{ __('Užduočių valdymas') }}
                </x-jet-responsive-nav-link>
            @endcan
            @can('notes view')
                <x-jet-responsive-nav-link href="{{ route('notes.index') }}" :active="request()->routeIs('notes.index')">
                    {{ __('Atmintinė') }}
                </x-jet-responsive-nav-link>
            @endcan
        </div>

        {{-- Company control --}}
        @role('admin')
        <div class="pt-2 pb-1 border-t border-gray-200 space-y-1">
            <div class="px-4 text-sm text-gray-500">Įmonės valdymas</div>
            <x-jet-responsive-nav-link href="{{ route('users') }}" :active="request()->routeIs('users')">
                Vartotojų valdymas
            </x-jet-responsive-nav-link>
        </div>
        @endrole

        {{-- System control --}}
        @role('global_admin')
            <div class="pt-2 pb-1 border-t border-gray-200 space-y-1">
                <div class="px-4 text-sm text-gray-500">Sistemos valdymas</div>
                <x-jet-responsive-nav-link href="{{ route('admin.permissions') }}" :active="request()->routeIs('admin.permissions')">
                    Leidimai
                </x-jet-responsive-nav-link>
            </div>
        @endrole

        <div class="pt-2 pb-1 border-t border-gray-200 space-y-1">
            <div class="px-4 text-sm text-gray-500">Vartotojo įmonė</div>
            @foreach (Auth::user()->relations()->get() as $relation)
                @if(Auth::user()->company->id === $relation->company_id)
                    <x-jet-responsive-nav-link :active="true">
                        {{ $relation->company->name }}
                    </x-jet-responsive-nav-link>
                @else
                    <form method="POST" action="{{ route('switch') }}">
                        @csrf
                        <input type="hidden" name="company_id" value="{{ $relation->company_id }}">
                        <x-jet-responsive-nav-link href="{{ route('switch') }}"
                                                   onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                            {{ $relation->company->name }}
                        </x-jet-responsive-nav-link>
                    </form>
                @endif
            @endforeach
        </div>

        <!-- User control -->
        <div class="pt-2 pb-1 border-t border-gray-200 space-y-1">
            <div class="px-4 text-sm text-gray-500">Vartotojo valdymas</div>
            <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                @if(Auth::user()->employees()->exists())
                    {{ Auth::user()->employee->name }}
                @else
                    {{ Auth::user()->name }}
                @endif
            </x-jet-responsive-nav-link>

            @if(Auth::user()->employees()->exists() && Auth::user()->current_employee > 0)
                <form method="POST" action="{{ route('employee.logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('employee.logout') }}"
                                         onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Atsijungti') }}
                    </x-jet-responsive-nav-link>
                </form>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Atsijungti') }}
                    </x-jet-responsive-nav-link>
                </form>
            @endif
        </div>
    </div>
</nav>
