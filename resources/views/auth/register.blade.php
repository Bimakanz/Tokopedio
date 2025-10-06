<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role pick -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Daftar Sebagai')" />

            <div class="grid grid-cols-2 gap-6 mt-2">
                <!-- Pengguna -->
                <label class="flex items-center p-4 border rounded-xl shadow-sm cursor-pointer 
                            hover:border-indigo-400 transition
                            dark:border-gray-700 dark:bg-gray-900 relative">
                    <!-- Radio button -->
                    <input type="radio" name="role" value="Buyer"
                        class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                        {{ old('role') == 'Buyer' ? 'checked' : '' }} required>

                    <!-- Isi card -->
                    <div class="ml-3">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Pengguna</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Daftar sebagai pengguna untuk membeli produk.
                        </p>
                    </div>
                </label>

                <!-- Penjual -->
                <label class="flex items-center p-4 border rounded-xl shadow-sm cursor-pointer 
                            hover:border-indigo-400 transition
                            dark:border-gray-700 dark:bg-gray-900 relative">
                    <!-- Radio button -->
                    <input type="radio" name="role" value="Seller"
                        class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                        {{ old('role') == 'Seller' ? 'checked' : '' }}>

                    <!-- Isi card -->
                    <div class="ml-3">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Penjual</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Daftar sebagai penjual untuk menawarkan produkmu.
                        </p>
                    </div>
                </label>
            </div>

            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
