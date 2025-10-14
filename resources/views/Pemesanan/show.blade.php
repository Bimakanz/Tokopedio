<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 space-y-6">
            <h1 class="text-center text-3xl font-extrabold mb-10 dark:text-white text-transparent bg-clip-text drop-shadow">
                Detail Pesanan
            </h1>

            <!-- Order Info -->
            <div class="flex justify-between items-start mb-6">
                <div class="flex-1">
                    <!-- Produk Name -->
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $order->produk->nama ?? '-' }}</h2>
                    
                    <!-- Produk Image -->
                    <div class="flex justify-center mt-4">
                        @if($order->produk && $order->produk->gambar)
                            <img src="{{ asset('storage/' . $order->produk->gambar) }}" alt="{{ $order->produk->nama }}"
                                class="w-60 h-60 object-cover rounded-xl shadow-md">
                        @else
                            <div class="w-60 h-60 flex items-center justify-center bg-gray-200 text-gray-500 rounded-xl">
                                Tidak ada gambar
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="text-right ml-6">
                    <!-- Harga -->
                    <div class="text-xl font-bold text-green-600 mb-2">
                        Rp {{ number_format((int) $order->total_harga, 0, ',', '.') }}
                    </div>
                    
                    <!-- Jumlah -->
                    <div class="text-gray-600 dark:text-gray-300">
                        {{ $order->jumlah }} Barang
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <!-- Nama Pemesan -->
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Nama Pemesan</span>
                    <span class="dark:text-white font-semibold text-lg">
                        {{ $order->nama_pemesan }}
                    </span>
                </div>

                <!-- Metode -->
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Metode</span>
                    <span class="text-lg uppercase font-semibold">
                        @php
                            $metodeColors = [
                                'COD' => 'bg-yellow-500 text-white',
                                'TRANSFER' => 'bg-white text-black dark:bg-gray-700',
                            ];
                            $metodeClass = $metodeColors[$order->metode] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300';
                        @endphp
                        <span class="{{ $metodeClass }} px-3 py-1 rounded-full">
                            {{ $order->metode }}
                        </span>
                    </span>
                </div>

                <!-- Kurir -->
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Kurir</span>
                    <span class="text-lg uppercase font-semibold">
                        @php
                            $kurirColors = [
                                'JNE' => 'bg-yellow-500 text-white',
                                'JNT' => 'bg-indigo-500 text-white',
                                'POS' => 'bg-blue-500 text-white',
                            ];
                            $kurirClass = $kurirColors[$order->kurir] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300';
                        @endphp
                        <span class="{{ $kurirClass }} px-3 py-1 rounded-full">
                            {{ $order->kurir }}
                        </span>
                    </span>
                </div>

                <!-- Alamat -->
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Alamat</span>
                    <span class="dark:text-white font-semibold text-lg text-right max-w-xs">
                        {{ $order->alamat }}
                    </span>
                </div>

                <!-- Status -->
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Status</span>
                    <span class="text-lg uppercase font-semibold">
                        @php
                            $statusColors = [
                                'Pending' => 'bg-yellow-500 text-white',
                                'Processed' => 'bg-indigo-500 text-white',
                                'Canceled' => 'bg-red-500 text-white',
                                'Confirmed' => 'bg-green-500 text-white',
                                'Sending' => 'bg-orange-500 text-white',
                            ];
                            $statusClass = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300';
                        @endphp
                        <span class="{{ $statusClass }} px-3 py-1 rounded-full">
                            {{ $order->status }}
                        </span>
                    </span>
                </div>
            </div>

            <!-- Ubah Status (for sellers) -->
            @if(auth()->user()->role === 'Seller')
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Ubah Status Pesanan</h3>
                <form action="{{ route('Pemesanan.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center">
                        <select name="status" class="rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white py-2 px-3">
                            <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Processed" {{ $order->status == 'Processed' ? 'selected' : '' }}>Processed</option>
                            <option value="Sending" {{ $order->status == 'Sending' ? 'selected' : '' }}>Sending</option>
                            <option value="Canceled" {{ $order->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                            <option value="Confirmed" {{ $order->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        </select>
                        <button type="submit" class="ml-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Perbarui Status
                        </button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>