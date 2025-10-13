<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-6">
        <h1 class="text-3xl font-extrabold text-center mb-10 bg-gradient-to-r from-orange-400 to-pink-600 text-transparent bg-clip-text">
            Daftar Orderan Masuk
        </h1>

        @if($orders->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left">Produk</th>
                            <th class="px-4 py-3 text-left">Pemesan</th>
                            <th class="px-4 py-3 text-left">Jumlah</th>
                            <th class="px-4 py-3 text-left">Metode</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Total</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-4 py-3 font-semibold">
                                    {{ $order->produk->nama ?? 'Produk dihapus' }}
                                </td>
                                <td class="px-4 py-3">{{ $order->nama_pemesan }}</td>
                                <td class="px-4 py-3">{{ $order->jumlah }}</td>
                                <td class="px-4 py-3">
                                    <span class="{{ $order->metode == 'TRANSFER' ? 'text-blue-500' : 'text-green-500' }}">
                                        {{ $order->metode }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="{{ $order->status == 'Pending' ? 'text-yellow-500' : 'text-green-500' }} font-semibold">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-green-500 font-bold">
                                    Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-gray-500">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-500 dark:text-gray-400 mt-10">
                Belum ada orderan masuk 😴
            </p>
        @endif
    </div>
</x-app-layout>
