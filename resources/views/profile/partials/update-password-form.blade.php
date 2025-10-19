<section class="space-y-6">
    <p class="text-gray-400">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-gray-300 mb-2" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" 
                class="block w-full bg-gray-700 border-gray-600 text-white placeholder-gray-400 rounded-xl py-3 px-4 focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:outline-none transition duration-200" 
                autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-gray-300 mb-2" />
            <x-text-input id="update_password_password" name="password" type="password" 
                class="block w-full bg-gray-700 border-gray-600 text-white placeholder-gray-400 rounded-xl py-3 px-4 focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:outline-none transition duration-200" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-gray-300 mb-2" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                class="block w-full bg-gray-700 border-gray-600 text-white placeholder-gray-400 rounded-xl py-3 px-4 focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:outline-none transition duration-200" 
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button class="px-6 py-3 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium shadow-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 transform hover:scale-105">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-400 flex items-center"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
