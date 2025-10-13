<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
        <!-- Judul -->
        <!-- Card -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 space-y-6">
            <h1
                class="text-center text-3xl font-extrabold mb-10 dark:text-white text-transparent bg-clip-text drop-shadow">
                Detail Produk
            </h1>
            <!-- Gambar -->
            <div class="flex justify-center">
                @if($produk->gambar)
                    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}"
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
                <span class="dark:text-white font-bold text-xl">
                    Rp {{ number_format((int) $orders->total_harga, 0, ',', '.') }}
                </span>
            </div>

            <!-- Status -->

            <div class="flex justify-between items-center border-t pt-4">
                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Metode</span>
                <span class="text-lg uppercase font-semibold">
                    @php
                        $metodeColors = [
                            'COD' => 'bg-yellow-500 text-white',
                            'TRANSFER' => 'bg-white text-black',
                        ];
                        $metodeClass = $metodeColors[$orders->metode] ?? 'bg-gray-100 text-gray-700';
                    @endphp
                    <span class="{{ $metodeClass }} px-2 py-1 rounded-full">
                        {{ $orders->metode }}
                    </span>
                </span>
            </div>

            <!-- Kurir -->
            <div class="flex justify-between items-center border-t pt-4">
                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Kurir</span>
                <span class="dark:text-white text-lg uppercase font-semibold">
                    @php
                        $kurirColors = [
                            'JNE' => 'bg-yellow-500 text-white',
                            'JNT' => 'bg-indigo-500 text-white',
                            'POS' => 'bg-blue-500 text-white',
                        ];
                        $kurirClass = $kurirColors[$orders->kurir] ?? 'bg-gray-100 text-gray-700';
                    @endphp
                    <span class="{{ $kurirClass }} px-2 py-1 rounded-full">
                        {{ $orders->kurir }}
                    </span>
                </span>
            </div>


            <!-- Alamat -->
            <div class="flex justify-between items-center border-t pt-4">
                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Alamat</span>
                <span class="dark:text-white text-lg font-semibold">
                    {{ $orders->alamat }}
                </span>
            </div>

            <!-- Status -->
            <div class="flex justify-between items-center border-t pt-4">
                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Status</span>
                <span class="dark:text-white text-lg uppercase font-semibold">
                    @php
                        $kurirColors = [
                            'Pending' => 'bg-yellow-500 text-white',
                            'Processed' => 'bg-indigo-500 text-white',
                            'Cancel' => 'bg-blue-500 text-white',
                            'Confirmed' => 'bg-green-500 text-white',
                            'Sending' => 'bg-orange-500 text-white',
                            'Delivered' => 'bg-green-500 text-white',
                        ];
                        $kurirClass = $kurirColors[$orders->status] ?? 'bg-gray-100 text-gray-700';
                    @endphp
                    <span class="{{ $kurirClass }} px-2 py-1 rounded-full">
                        {{ $orders->status }}
                    </span>
                </span>
            </div>

            <!-- Stok -->
            <div class="flex justify-between items-center border-t pt-4">
                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Barang Dibeli</span>
                <span class="dark:text-white font-semibold text-xl">
                    {{ $orders->jumlah }} Barang
                </span>
            </div>

        </div>
    </div>
</x-app-layout>