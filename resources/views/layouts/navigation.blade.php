<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-20 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('productes')" :active="request()->routeIs('productes')">
                        {{ __('Productes') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side - Log in and Auth -->
            <div class="flex items-center space-x-4">
                @guest
                <!-- Log in Button -->
                <div>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Log in') }}
                    </x-nav-link>
                </div>
                @endguest

                @auth
                <!-- Icona del Carrito amb contador -->
                <div style="margin-right: 20px; display: flex; align-items: center; position: relative;">
                    <a href="{{ route('carrito') }}" style="text-decoration: none; color: black; position: relative;">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        @php
                            $productCount = session('carrito') ? count(session('carrito')) : 0;
                        @endphp
                        @if ($productCount > 0)
                            <span 
                                style="position: absolute; top: -10px; right: -10px; background: red; color: white; 
                                border-radius: 50%; width: 20px; height: 20px; display: flex; justify-content: center; 
                                align-items: center; font-size: 12px;">
                                {{ $productCount }}
                            </span>
                        @endif
                    </a>
                </div>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a 1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Tancar sessió') }}
                            </x-dropdown-link>
                        </form>

                        <!-- Idioma Dropdown -->
                        <div class="border-t border-gray-200 mt-2 pt-2 px-4">
                            <p class="text-sm font-medium text-gray-500">{{ __('Idioma') }}</p>
                            <div class="flex flex-col space-y-2 mt-2">
                                <x-dropdown-link :href="url('/lang/ca')">
                                    <span class="{{ App::currentLocale() === 'ca' ? 'underline font-bold' : '' }}">
                                        {{ __('Català') }}
                                    </span>
                                </x-dropdown-link>
                                <x-dropdown-link :href="url('/lang/es')">
                                    <span class="{{ App::currentLocale() === 'es' ? 'underline font-bold' : '' }}">
                                        {{ __('Castellà') }}
                                    </span>
                                </x-dropdown-link>
                                <x-dropdown-link :href="url('/lang/en')">
                                    <span class="{{ App::currentLocale() === 'en' ? 'underline font-bold' : '' }}">
                                        {{ __('Anglès') }}
                                    </span>
                                </x-dropdown-link>
                                <x-dropdown-link :href="url('/lang/fr')">
                                    <span class="{{ App::currentLocale() === 'fr' ? 'underline font-bold' : '' }}">
                                        {{ __('Francès') }}
                                    </span>
                                </x-dropdown-link>
                            </div>
                        </div>


                    </x-slot>
                </x-dropdown>
                @endauth
            </div>
        </div>
    </div>
</nav>
