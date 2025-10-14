<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 to-gray-800 p-4">
        <div class="w-full max-w-md">
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-2xl rounded-2xl p-8 border border-gray-700">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-white">Buat Akun Baru</h2>
                    <p class="text-gray-400 mt-2">Daftar untuk mulai berbelanja atau berjualan</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-300" />
                        <x-text-input id="name" class="block mt-1 w-full border-gray-700 bg-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg py-3 px-4" 
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
                        <x-text-input id="email" class="block mt-1 w-full border-gray-700 bg-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg py-3 px-4" 
                            type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Role pick -->
                    <div class="mb-6">
                        <x-input-label for="role" :value="__('Daftar Sebagai')" class="text-gray-300" />

                        <div class="grid grid-cols-2 gap-4 mt-3">
                            <!-- Pengguna -->
                            <label class="flex flex-col items-center p-5 border rounded-xl shadow-sm cursor-pointer 
                                        hover:border-indigo-400 transition
                                        dark:border-gray-700 bg-gray-700 hover:bg-gray-600 relative {{ old('role') == 'Buyer' ? 'border-indigo-500 ring-2 ring-indigo-500/50' : '' }}">
                                <!-- Radio button -->
                                <input type="radio" name="role" value="Buyer"
                                    class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                    {{ old('role') == 'Buyer' ? 'checked' : '' }} required>

                                <!-- Icon -->
                                <div class="mb-3">
                                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>

                                <!-- Isi card -->
                                <div class="text-center">
                                    <h3 class="text-lg font-semibold text-white">Pengguna</h3>
                                    <p class="mt-2 text-sm text-gray-400">
                                        Beli produk yang Anda butuhkan
                                    </p>
                                </div>
                            </label>

                            <!-- Penjual -->
                            <label class="flex flex-col items-center p-5 border rounded-xl shadow-sm cursor-pointer 
                                        hover:border-indigo-400 transition
                                        dark:border-gray-700 bg-gray-700 hover:bg-gray-600 relative {{ old('role') == 'Seller' ? 'border-indigo-500 ring-2 ring-indigo-500/50' : '' }}">
                                <!-- Radio button -->
                                <input type="radio" name="role" value="Seller"
                                    class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                    {{ old('role') == 'Seller' ? 'checked' : '' }}>

                                <!-- Icon -->
                                <div class="mb-3">
                                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>

                                <!-- Isi card -->
                                <div class="text-center">
                                    <h3 class="text-lg font-semibold text-white">Penjual</h3>
                                    <p class="mt-2 text-sm text-gray-400">
                                        Jual produk Anda kepada pelanggan
                                    </p>
                                </div>
                            </label>
                        </div>

                        <x-input-error :messages="$errors->get('role')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-300" />

                        <x-text-input id="password" class="block mt-1 w-full border-gray-700 bg-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg py-3 px-4"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-300" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-700 bg-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg py-3 px-4"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
                    </div>

                    <div class="flex items-center justify-center mt-6">
                        <x-primary-button class="w-full py-3 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 rounded-lg text-white font-semibold transition duration-300 transform hover:scale-105">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-400 text-sm">Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-medium">Masuk Sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>