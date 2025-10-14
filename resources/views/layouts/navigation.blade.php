<nav x-data="{ open: false }" class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-lg border-b border-gray-100/50 dark:border-gray-700/50 rounded-b-2xl shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-18 items-center">
            <div class="flex items-center">
                <!-- Logo with animation -->
                <div class="shrink-0 flex items-center transform transition-all duration-300 hover:scale-105">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                        <div class="relative">
                            <x-application-logo class="block h-10 w-auto fill-current text-indigo-600 dark:text-indigo-400" />
                            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/20 to-purple-500/20 rounded-full blur-md animate-pulse"></div>
                        </div>
                        <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500">
                             {{ __('Tokopedio') }}
                    </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-12 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-300 hover:scale-105 hover:shadow-md relative group">
                        <span class="relative z-10">{{ __('Dashboard') }}</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </x-nav-link>
                    
                    @if(Auth::user()->role === 'Buyer')
                    <x-nav-link :href="route('User.index')" :active="request()->routeIs('User.index')" class="rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-300 hover:scale-105 hover:shadow-md relative group">
                        <span class="relative z-10">{{ __('Pemesanan') }}</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </x-nav-link>
                    @elseif(Auth::user()->role === 'Seller')
                    <x-nav-link :href="route('Pemesanan.index')" :active="request()->routeIs('Pemesanan.index')" class="rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-300 hover:scale-105 hover:shadow-md relative group">
                        <span class="relative z-10">{{ __('Pemesanan') }}</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </x-nav-link>
                    @endif
                    
                    @if(Auth::user()->role === 'Seller')
                    <x-nav-link :href="route('Seller.index')" :active="request()->routeIs('Seller.index')" class="rounded-xl px-4 py-2.5 text-sm font-medium transition-all duration-300 hover:scale-105 hover:shadow-md relative group">
                        <span class="relative z-10">{{ __('Seller') }}</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Theme Toggle and Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2.5 rounded-full border border-transparent text-sm leading-4 font-medium text-gray-700 dark:text-gray-300 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 hover:from-indigo-100 hover:to-purple-100 dark:hover:from-indigo-900 dark:hover:to-purple-900 focus:outline-none transition-all duration-300 hover:scale-105 shadow-md group">
                            <div class="relative flex items-center space-x-2.5">
                                <div class="relative">
                                    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 w-9 h-9 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-lg">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center">
                                        <div class="w-2 h-2 bg-white rounded-full"></div>
                                    </div>
                                </div>
                                <span class="hidden md:block font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</span>
                                <div class="ms-1 transition-transform duration-300 group-hover:rotate-180">
                                    <svg class="fill-current h-4 w-4 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>{{ __('Profile') }}</span>
                            </div>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>{{ __('Log Out') }}</span>
                                </div>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-full text-gray-500 dark:text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 focus:text-gray-600 dark:focus:text-gray-300 transition duration-150 ease-in-out group">
                    <div class="relative w-6 h-6">
                        <span :class="{'hidden': open, 'block': ! open }" class="block">
                            <div class="absolute top-1 left-0 w-full h-0.5 bg-gray-600 dark:bg-gray-400 rounded-full transition-all duration-300 group-hover:translate-x-1"></div>
                            <div class="absolute top-1/2 left-0 w-full h-0.5 bg-gray-600 dark:bg-gray-400 rounded-full transition-all duration-300 -translate-y-1/2 group-hover:translate-x-1 delay-75"></div>
                            <div class="absolute bottom-1 left-0 w-full h-0.5 bg-gray-600 dark:bg-gray-400 rounded-full transition-all duration-300 group-hover:translate-x-1 delay-150"></div>
                        </span>
                        <span :class="{'block': open, 'hidden': ! open }" class="hidden">
                            <div class="absolute top-1/2 left-1/2 w-6 h-0.5 bg-gray-600 dark:bg-gray-400 rounded-full -translate-x-1/2 -translate-y-1/2 rotate-45"></div>
                            <div class="absolute top-1/2 left-1/2 w-6 h-0.5 bg-gray-600 dark:bg-gray-400 rounded-full -translate-x-1/2 -translate-y-1/2 -rotate-45"></div>
                        </span>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>{{ __('Dashboard') }}</span>
                </div>
            </x-responsive-nav-link>
            
            @if(Auth::user()->role === 'Buyer')
            <x-responsive-nav-link :href="route('User.index')" :active="request()->routeIs('User.index')">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span>{{ __('Pemesanan') }}</span>
                </div>
            </x-responsive-nav-link>
            @elseif(Auth::user()->role === 'Seller')
            <x-responsive-nav-link :href="route('Pemesanan.index')" :active="request()->routeIs('Pemesanan.index')">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span>{{ __('Pemesanan') }}</span>
                </div>
            </x-responsive-nav-link>
            @endif
            
            @if(Auth::user()->role === 'Seller')
            <x-responsive-nav-link :href="route('Seller.index')">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>{{ __('Seller') }}</span>
                </div>
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-500 w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>{{ __('Profile') }}</span>
                    </div>
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>{{ __('Log Out') }}</span>
                        </div>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>