<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl py-12 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Selamat Datang Mang, {{ Auth::user()->name }} !
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($produk as $p)
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden flex flex-col">

                    <!-- Gambar Produk -->
                    <div class="h-48 w-full overflow-hidden">
                        <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->nama }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Isi Card -->
                    <div class="p-4 flex flex-col justify-between flex-1">

                        <!-- Nama -->
                        <h2 class="text-lg font-bold text-gray-800 mb-2">
                            {{ $p->nama }}
                        </h2>

                        <!-- Harga -->
                        <p class="text-pink-600 font-extrabold text-xl mb-1">
                            Rp {{ number_format($p->harga, 0, ',', '.') }}
                        </p>

                        <!-- Status -->
                        <p class="mb-4 {{ $p->status === 'Aktif' ? 'text-green-500' : 'text-red-500' }} font-semibold">
                            {{ $p->status }}
                        </p>

                        <!-- Tombol Beli -->
                        <a href="{{ route('User.create', $p->id) }}"
                            class="block shadow-xl text-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg py-2 transition">
                            🛒 Beli
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>