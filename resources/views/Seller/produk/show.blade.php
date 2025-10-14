<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
        <!-- Judul -->
        <h1 class="text-center text-3xl font-extrabold mb-10 text-white bg-clip-text drop-shadow">
            Detail Produk
        </h1>

        <!-- Card -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 space-y-6">
            <!-- Gambar -->
            <div class="flex justify-center">
                @if($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}" 
                         alt="{{ $produk->nama }}" 
                         class="w-80 h-80 object-cover rounded-xl shadow-md">
                @else
                    <div class="w-80 h-80 flex items-center justify-center bg-gray-200 text-gray-500 rounded-xl">
                        Tidak ada gambar
                    </div>
                @endif
            </div>

            <!-- Nama -->
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $produk->nama }}</h2>
            </div>

            <!-- Harga -->
            <div class="flex justify-between items-center border-t pt-4">
                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Harga</span>
                <span class="text-green-500 font-bold text-xl">
                    Rp {{ number_format($produk->harga, 2, ',', '.') }}
                </span>
            </div>

            <!-- Status -->
            <div class="flex justify-between items-center border-t pt-4">
                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Status</span>
                <span class="{{ $produk->status === 'Aktif' ? 'text-green-500' : 'text-red-500' }} text-lg uppercase font-semibold">
                    {{ $produk->status }}
                </span>
            </div>

            <!-- Stok -->
            <div class="flex justify-between items-center border-t pt-4">
                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Stok Tersedia</span>
                <span class="text-green-500 font-semibold text-xl">
                    {{ $produk->stok }} Barang
                </span>
            </div>

            <!-- Deskripsi -->
            <div class="border-t pt-4">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">Deskripsi</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    {{ $produk->deskripsi ?? 'Tidak ada deskripsi produk.' }}
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
