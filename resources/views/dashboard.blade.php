<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-gray-800 to-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-700">
                <div class="p-8 text-center">
                    <h1 class="text-3xl font-bold text-white mb-2">
                        Selamat Datang, {{ Auth::user()->name }}!
                    </h1>
                    <p class="text-gray-400">
                        {{ Auth::user()->role === 'Seller' ? 'Kelola produk dan pesanan Anda' : 'Temukan produk favorit Anda' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($produk as $p)
                @if ($p->status === 'Aktif')
                <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-2xl overflow-hidden flex flex-col shadow-lg border border-gray-700 hover:border-indigo-500 transition-all duration-300 transform hover:-translate-y-1">

                    <!-- Gambar Produk -->
                    <div class="h-56 w-full overflow-hidden">
                        @if($p->gambar)
                            <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->nama }}"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-700 text-gray-400">
                                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Isi Card -->
                    <div class="p-6 flex flex-col justify-between flex-1">

                        <!-- Nama -->
                        <h2 class="text-xl font-bold text-white mb-3">
                            {{ $p->nama }}
                        </h2>

                        <!-- Harga -->
                        <p class="text-indigo-400 font-bold text-2xl mb-3">
                            Rp {{ number_format($p->harga, 0, ',', '.') }}
                        </p>

                        <!-- Status -->
                        <p class="mb-4 {{ $p->status === 'Aktif' ? 'text-green-500' : 'text-red-500' }} font-semibold">
                            {{ $p->status }}
                        </p>

                        <!-- Tombol Beli -->
                        <a href="{{ route('User.create', $p->id) }}"
                            class="block shadow-lg text-center bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl py-3 transition transform hover:scale-105">
                            🔥 Beli Produk
                        </a>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>