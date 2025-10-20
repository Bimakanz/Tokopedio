<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-full flex items-center justify-center bg-gradient-to-br from-gray-900 to-gray-800 p-4 mt-[50px]">
        <div class="w-full mb-[230px] max-w-xl">
            <div class="bg-gradient-to-br mt-[100px] from-gray-800 to-gray-900 shadow-2xl rounded-2xl p-8 border border-gray-700">
                <div class="text-center mb-10">
                    <h2 class="text-4xl font-bold text-white mb-3">Selamat Datang Kembali</h2>
                    <p class="text-gray-400 text-lg">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
                        <x-text-input id="email" class="block mt-1 w-full border-gray-700 bg-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl py-3 px-4" 
                            type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-300" />

                        <x-text-input id="password" class="block mt-1 w-full border-gray-700 bg-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl py-3 px-4"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded bg-gray-700 border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-indigo-600 focus:ring-offset-0" name="remember">
                            <span class="ml-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-400 hover:text-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-800" 
                                href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center justify-center mt-2">
                        <x-primary-button class="w-full max-w-xs py-4 px-6 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 rounded-xl text-white font-bold text-lg shadow-lg transition-all duration-300 transform hover:scale-105">
                            {{ __('Masuk') }}
                        </x-primary-button>
                    </div>
                </form>
                
                <div class="mt-8 text-center">
                    <p class="text-gray-400">Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-bold">Daftar Sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>