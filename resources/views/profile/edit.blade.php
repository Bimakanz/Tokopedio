<x-app-layout>
    <div class="pt-[150px] pb-[50px] p-6">
        <div class="text-center mb-10 animate-fadeIn">
            <h1 class="text-4xl font-extrabold text-white mb-3 tracking-tight bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500">
                {{ __('Profile Settings') }}
            </h1>
            <p class="text-gray-400 max-w-md mx-auto">Manage your account information and security settings</p>
        </div>

        <div class="max-w-4xl mx-auto space-y-8">
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-8 border border-gray-700">
                <h2 class="text-2xl font-bold text-white mb-6 pb-3 border-b border-gray-700">
                    {{ __('Profile Information') }}
                </h2>
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-8 border border-gray-700">
                <h2 class="text-2xl font-bold text-white mb-6 pb-3 border-b border-gray-700">
                    {{ __('Update Password') }}
                </h2>
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-8 border border-gray-700">
                <h2 class="text-2xl font-bold text-white mb-6 pb-3 border-b border-gray-700">
                    {{ __('Delete Account') }}
                </h2>
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
