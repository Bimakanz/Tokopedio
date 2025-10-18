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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($produk as $p)
                @if ($p->status === 'Aktif')
                <div class="group relative bg-gradient-to-b from-gray-800 to-gray-900 rounded-2xl overflow-hidden flex flex-col shadow-xl border border-gray-700 transition-all duration-500 hover:shadow-2xl hover:shadow-indigo-500/20 hover:border-indigo-500/50 hover:-translate-y-2">

                    <!-- Gambar Produk dengan overlay efek -->
                    <div class="relative overflow-hidden">
                        <div class="h-56 w-full">
                            @if($p->gambar)
                                <img src="{{ asset('storage/' . $p->gambar) }}" alt="{{ $p->nama }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-700 text-gray-400">
                                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Overlay saat hover -->
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end">
                            <div class="p-6 w-full">
                                <div class="flex justify-between items-center">
                                    <span class="bg-green-500/20 uppercase text-green-400 text-xs px-2 py-1 rounded-full font-medium">Tersedia</span>
                                    <span class="text-gray-300 uppercase font-bold text-sm">{{ $p->stok }} Stok</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Isi Card -->
                    <div class="p-6 flex flex-col justify-between flex-1 transition-all duration-300 group-hover:pb-10">

                        <!-- Nama Produk -->
                        <div class="mb-4">
                            <h2 class="text-xl font-bold text-white mb-2 group-hover:text-indigo-300 transition-colors duration-300">
                                {{ $p->nama }}
                            </h2>

                            <!-- Harga -->
                            <p class="text-indigo-400 font-bold text-xl">
                                Rp {{ number_format($p->harga, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <span class="inline-flex uppercase items-center px-3 py-1 rounded-full text-sm font-medium {{ $p->status === 'Aktif' ? 'bg-green-900/30 text-green-400' : 'bg-red-900/30 text-red-400' }}">
                                <span class="w-2 h-2 uppercase rounded-full {{ $p->status === 'Aktif' ? 'bg-green-500' : 'bg-red-500' }} mr-2"></span>
                                {{ $p->status }}
                            </span>
                        </div>

                        <!-- Tombol Beli -->
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-4 group-hover:translate-y-0">
                            <a href="{{ route('User.create', $p->id) }}"
                                class="block text-center bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl py-4 transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Beli Sekarang
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>