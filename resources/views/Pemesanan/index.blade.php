<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8">
            <h1 class="text-center text-3xl font-extrabold mb-8 dark:text-white text-transparent bg-clip-text drop-shadow">
                Daftar Pesanan
            </h1>

            @if($orders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Produk</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Gambar</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Pemesan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jumlah</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Harga</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Alamat</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kurir</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Metode</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($orders as $order)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-750 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $order->produk->nama ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($order->produk && $order->produk->gambar)
                                        <img src="{{ asset('storage/' . $order->produk->gambar) }}" 
                                             alt="{{ $order->produk->nama }}" 
                                             class="w-16 h-16 object-cover rounded-lg shadow">
                                    @else
                                        <div class="w-16 h-16 flex items-center justify-center bg-gray-200 text-gray-500 rounded-lg">
                                            -
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $order->nama_pemesan }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $order->jumlah }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-green-600">
                                        Rp {{ number_format((int) $order->total_harga, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <div class="text-sm text-gray-900 dark:text-white break-words whitespace-normal">{{ $order->alamat }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($order->kurir == 'JNE') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                                        @elseif($order->kurir == 'JNT') bg-indigo-100 text-indigo-800 dark:bg-indigo-800 dark:text-indigo-100
                                        @else bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100
                                        @endif">
                                        {{ $order->kurir }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($order->metode == 'COD') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                                        @else bg-white text-black dark:bg-gray-700 dark:text-white
                                        @endif">
                                        {{ $order->metode }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($order->status == 'Pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                                        @elseif($order->status == 'Processed') bg-indigo-100 text-indigo-800 dark:bg-indigo-800 dark:text-indigo-100
                                        @elseif($order->status == 'Confirmed') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                        @elseif($order->status == 'Sending') bg-orange-100 text-orange-800 dark:bg-orange-800 dark:text-orange-100
                                        @else bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
                                        @endif">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if(auth()->user()->role === 'Seller')
                                    <form action="{{ route('Pemesanan.updateStatus', $order->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white text-xs p-1">
                                            <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Processed" {{ $order->status == 'Processed' ? 'selected' : '' }}>Processed</option>
                                            <option value="Sending" {{ $order->status == 'Sending' ? 'selected' : '' }}>Sending</option>
                                            <option value="Canceled" {{ $order->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                                            <option value="Confirmed" {{ $order->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        </select>
                                        <button type="submit" class="ml-1 bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700">
                                            Ubah
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-10">
                    <p class="text-gray-600 dark:text-gray-400">Tidak ada pesanan ditemukan.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>