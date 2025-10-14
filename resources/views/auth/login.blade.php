<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 to-gray-800 p-4">
        <div class="w-full max-w-md">
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-2xl rounded-2xl p-8 border border-gray-700">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-white">Selamat Datang Kembali</h2>
                    <p class="text-gray-400 mt-2">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
                        <x-text-input id="email" class="block mt-1 w-full border-gray-700 bg-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg py-3 px-4" 
                            type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-300" />

                        <x-text-input id="password" class="block mt-1 w-full border-gray-700 bg-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg py-3 px-4"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded bg-gray-700 border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-indigo-600 focus:ring-offset-0" name="remember">
                            <span class="ml-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-indigo-400 hover:text-indigo-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-800" 
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        
                        <a class="underline text-sm text-gray-400 hover:text-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-800" 
                            href="{{ route('register') }}">
                            {{ __('Register') }}
                        </a>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 rounded-lg text-white font-semibold transition duration-300 transform hover:scale-105">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
            
            <div class="text-center mt-6">
                <p class="text-gray-500 text-sm">Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-medium">Daftar Sekarang</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>