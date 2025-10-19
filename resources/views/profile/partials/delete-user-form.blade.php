<section class="space-y-6">
    <p class="text-gray-400">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </p>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-3 rounded-xl bg-gradient-to-r from-red-600 to-pink-600 text-white font-medium shadow-lg hover:from-red-700 hover:to-pink-700 transition-all duration-200 transform hover:scale-105"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-gray-800 rounded-2xl">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-white mb-2">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="text-gray-300 mb-2" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full bg-gray-700 border-gray-600 text-white placeholder-gray-400 rounded-xl py-3 px-4 focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:outline-none transition duration-200"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-4 py-2 rounded-xl bg-gray-700 text-white font-medium hover:bg-gray-600 transition-all duration-200">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="px-4 py-2 rounded-xl bg-gradient-to-r from-red-600 to-pink-600 text-white font-medium hover:from-red-700 hover:to-pink-700 transition-all duration-200">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
