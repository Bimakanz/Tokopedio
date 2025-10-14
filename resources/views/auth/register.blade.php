<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 to-gray-800 p-4">
        <div class="w-full max-w-2xl">
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-2xl rounded-2xl p-8 border border-gray-700">
                <div class="text-center mb-10">
                    <h2 class="text-4xl font-bold text-white mb-3">Buat Akun Baru</h2>
                    <p class="text-gray-400 text-lg">Daftar untuk mulai berbelanja atau berjualan</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-300" />
                            <x-text-input id="name" class="block mt-1 w-full border-gray-700 bg-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl py-3 px-4" 
                                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
                        </div>

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
                            <x-text-input id="email" class="block mt-1 w-full border-gray-700 bg-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl py-3 px-4" 
                                type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                        </div>
                    </div>

                    <!-- Role pick -->
                    <div class="mt-8 mb-8">
                        <x-input-label for="role" :value="__('Daftar Sebagai')" class="text-gray-300 text-lg font-medium" />

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <!-- Pengguna -->
                            <label class="flex flex-col items-center p-6 border-2 rounded-2xl shadow-lg cursor-pointer 
                                        hover:border-indigo-400 transition-all duration-300
                                        dark:border-gray-700 bg-gray-700 hover:bg-gray-600 relative group {{ old('role') == 'Buyer' ? 'border-indigo-500 ring-4 ring-indigo-500/30 bg-indigo-900/20' : '' }}">
                                <!-- Radio button -->
                                <input type="radio" name="role" value="Buyer"
                                    class="absolute top-4 right-4 h-5 w-5 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                    {{ old('role') == 'Buyer' ? 'checked' : '' }} required>

                                <!-- Icon -->
                                <div class="mb-4">
                                    <svg class="w-14 h-14 text-indigo-400 group-hover:text-indigo-300 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>

                                <!-- Isi card -->
                                <div class="text-center">
                                    <h3 class="text-xl font-bold text-white group-hover:text-indigo-200 transition-colors duration-300">Pengguna</h3>
                                    <p class="mt-3 text-gray-400 group-hover:text-indigo-300 transition-colors duration-300">
                                        Beli produk yang Anda butuhkan
                                    </p>
                                </div>
                            </label>

                            <!-- Penjual -->
                            <label class="flex flex-col items-center p-6 border-2 rounded-2xl shadow-lg cursor-pointer 
                                        hover:border-indigo-400 transition-all duration-300
                                        dark:border-gray-700 bg-gray-700 hover:bg-gray-600 relative group {{ old('role') == 'Seller' ? 'border-indigo-500 ring-4 ring-indigo-500/30 bg-indigo-900/20' : '' }}">
                                <!-- Radio button -->
                                <input type="radio" name="role" value="Seller"
                                    class="absolute top-4 right-4 h-5 w-5 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                    {{ old('role') == 'Seller' ? 'checked' : '' }}>

                                <!-- Icon -->
                                <div class="mb-4">
                                    <svg class="w-14 h-14 text-indigo-400 group-hover:text-indigo-300 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>

                                <!-- Isi card -->
                                <div class="text-center">
                                    <h3 class="text-xl font-bold text-white group-hover:text-indigo-200 transition-colors duration-300">Penjual</h3>
                                    <p class="mt-3 text-gray-400 group-hover:text-indigo-300 transition-colors duration-300">
                                        Jual produk Anda kepada pelanggan
                                    </p>
                                </div>
                            </label>
                        </div>

                        <x-input-error :messages="$errors->get('role')" class="mt-4 text-red-400" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />

                            <x-text-input id="password" class="block mt-1 w-full border-gray-700 bg-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl py-3 px-4"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-300" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-700 bg-gray-700 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl py-3 px-4"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
                        </div>
                    </div>

                    <div class="flex items-center justify-center mt-10">
                        <x-primary-button class="w-full max-w-xs py-4 px-6 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 rounded-xl text-white font-bold text-lg shadow-lg transition-all duration-300 transform hover:scale-105">
                            {{ __('Daftar Sekarang') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-gray-400">Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-bold">Masuk Sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>