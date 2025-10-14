<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Tokopedio') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */@layer theme{:root,:host{--font-sans:'Figtree',ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-serif:ui-serif,Georgia,Cambria,"Times New Roman",Times,serif;--font-mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--color-red-50:oklch(.971 .013 17.38);--color-red-100:oklch(.936 .032 17.717);--color-red-200:oklch(.885 .062 18.334);--color-red-300:oklch(.808 .114 19.571);--color-red-400:oklch(.704 .191 22.216);--color-red-500:oklch(.637 .237 25.331);--color-red-600:oklch(.577 .245 27.325);--color-red-700:oklch(.505 .213 27.518);--color-red-800:oklch(.444 .177 26.899);--color-red-900:oklch(.396 .141 25.723);--color-red-950:oklch(.258 .092 26.042);--color-orange-50:oklch(.98 .016 73.684);--color-orange-100:oklch(.954 .038 75.164);--color-orange-200:oklch(.901 .076 70.697);--color-orange-300:oklch(.837 .128 66.29);--color-orange-400:oklch(.75 .183 55.934);--color-orange-500:oklch(.705 .213 47.604);--color-orange-600:oklch(.646 .222 41.116);--color-orange-700:oklch(.553 .195 38.402);--color-orange-800:oklch(.47 .157 37.304);--color-orange-900:oklch(.408 .123 38.172);--color-orange-950:oklch(.266 .079 36.259);--color-amber-50:oklch(.987 .022 95.277);--color-amber-100:oklch(.962 .059 95.617);--color-amber-200:oklch(.924 .12 95.746);--color-amber-300:oklch(.879 .169 91.605);--color-amber-400:oklch(.828 .189 84.429);--color-amber-500:oklch(.769 .188 70.08);--color-amber-600:oklch(.666 .179 58.318);--color-amber-700:oklch(.555 .163 48.998);--color-amber-800:oklch(.473 .137 46.201);--color-amber-900:oklch(.414 .112 45.904);--color-amber-950:oklch(.279 .077 45.635);--color-yellow-50:oklch(.987 .026 102.212);--color-yellow-100:oklch(.973 .071 103.193);--color-yellow-200:oklch(.945 .129 101.54);--color-yellow-300:oklch(.905 .182 98.111);--color-yellow-400:oklch(.852 .199 91.936);--... [truncated]
            </style>
        @endif
    </head>
    <body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-gray-100 min-h-screen flex flex-col">
        <header class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-indigo-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 3H5L5.4 5M7 13H17L21 4H5.4M7 13L5.4 5M7 13L4.707 15.293C4.077 15.923 4.523 17 5.414 17H17M17 17C15.895 17 15 17.895 15 19C15 20.105 15.895 21 17 21C18.105 21 19 20.105 19 19C19 17.895 18.105 17 17 17ZM9 19C9 20.105 8.105 21 7 21C5.895 21 5 20.105 5 19C5 17.895 5.895 17 7 17C8.105 17 9 17.895 9 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-500">
                        {{ __('Tokopedio') }}
                    </span>
                </div>

                <nav class="flex space-x-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="px-4 py-2 text-sm font-medium bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-medium bg-gray-800 hover:bg-gray-700 text-gray-200 rounded-lg transition"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="px-4 py-2 text-sm font-medium bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            </div>
        </header>

        <div class="flex-grow flex items-center justify-center px-4 sm:px-6">
            <main class="max-w-5xl w-full">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-700">
                    <div class="p-8 md:p-12 lg:px-16 lg:py-12">
                        <div class="max-w-xl">
                            <h1 class="text-3xl font-bold text-white sm:text-4xl">
                                Selamat Datang di Tokopedio
                            </h1>

                            <p class="mt-4 max-w-lg text-gray-300">
                                Temukan berbagai produk berkualitas tinggi dengan harga terbaik. 
                                Nikmati pengalaman belanja yang mudah dan aman.
                            </p>

                            <div class="mt-8 grid grid-cols-2 gap-4">
                                <div class="bg-gray-700 rounded-lg p-4">
                                    <h3 class="text-lg font-semibold text-indigo-400">Produk Berkualitas</h3>
                                    <p class="mt-2 text-gray-300">Kami menawarkan produk dengan kualitas terbaik untuk kebutuhan Anda.</p>
                                </div>
                                <div class="bg-gray-700 rounded-lg p-4">
                                    <h3 class="text-lg font-semibold text-indigo-400">Pengiriman Cepat</h3>
                                    <p class="mt-2 text-gray-300">Pengiriman aman dan cepat ke seluruh wilayah Indonesia.</p>
                                </div>
                            </div>

                            <div class="mt-12">
                                <a
                                    href="{{ route('register') }}"
                                    class="inline-block rounded-lg bg-indigo-600 px-8 py-3 text-center text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring"
                                >
                                    Mulai Belanja
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-gray-700 to-gray-800 p-8 border-t border-gray-700">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-indigo-400">1000+</div>
                                <div class="text-gray-400 mt-1">Produk Tersedia</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-indigo-400">500+</div>
                                <div class="text-gray-400 mt-1">Pelanggan</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-indigo-400">24/7</div>
                                <div class="text-gray-400 mt-1">Layanan</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-indigo-400">99%</div>
                                <div class="text-gray-400 mt-1">Puas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <footer class="py-6 text-center text-gray-500 text-sm">
            <p>© {{ date('Y') }} {{ config('app.name', 'Tokopedio') }}.</p>
        </footer>
    </body>
</html>