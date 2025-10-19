<x-app-layout>

    <!-- Bagian sambutan -->
          <div class="pt-[150px] pb-[29px] p-6 animate-fadeIn">
        <!-- Notifikasi keberhasilan -->
        @if(session('success'))
            <div class="mb-6">
                <div class="bg-green-900/30 border border-green-700 text-green-200 px-6 py-4 rounded-xl flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif
        
        <div class="p-10 rounded-2xl shadow-xl border border-gray-700 bg-gradient-to-br from-gray-800 to-gray-900">
            <div class="flex flex-row justify-between">
                <div class="text-white">
                    <h1 class="font-bold text-3xl text-white bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500">
                        Kelola Pesanan anda</h1>
                    <p class="text-center text-2xl text-gray-300 mt-2">
                        Kelola pesanan anda dengan mudah di sini.</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Bagian Tabel Pesanan -->
    <div class="max-w-screen-full mx-6 animate-fadeIn">
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-700">
            <div class="p-6 text-gray-200">
                <h1
                    class="text-center text-3xl font-extrabold mb-8 text-white bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500">
                    Daftar Pesanan
                </h1>
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-900 text-green-200 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if($orders->isEmpty())
                    <div class="p-4 bg-gray-800 rounded-lg border border-gray-700 text-center">
                        <p class="text-gray-400">Belum ada pesanan.</p>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-xl">
                        <table class="min-w-full divide-y divide-gray-700 uppercase">
                            <thead class="bg-gray-700 text-gray-300">
                                <tr>
                                    <th class="px-4 py-3 text-center">No</th>
                                    <th class="px-4 py-3 text-center">Produk</th>
                                    <th class="px-4 py-3 text-center">Jumlah</th>
                                    <th class="px-4 py-3 text-center">Kurir</th>
                                    <th class="px-4 py-3 text-center">Metode</th>
                                    <th class="px-4 py-3 text-center">Status</th>
                                    <th class="px-4 py-3 text-center">Total</th>
                                    <th class="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800">
                                @foreach($orders as $order)
                                    <tr
                                        class="border-b border-gray-700 hover:bg-gray-750 transition">
                                        <td class="px-4 py-3 text-center text-gray-200">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 text-center text-gray-200">{{ $order->produk->nama ?? '—' }}</td>
                                        <td class="px-4 py-3 text-center text-gray-200">{{ $order->jumlah }}</td>
                                        <td class="px-4 py-3 text-center">
                                            @php
                                                $kurirColors = [
                                                    'JNT' => 'bg-indigo-900/30 text-indigo-400',
                                                    'POS' => 'bg-blue-900/30 text-blue-400',
                                                    'JNE' => 'bg-yellow-900/30 text-yellow-400',
                                                ];
                                                $kurirClass = $kurirColors[$order->kurir] ?? 'bg-gray-700 text-gray-300';
                                            @endphp
                                            <span class="px-3 py-1.5 uppercase inline-flex text-xs leading-5 font-bold rounded-lg {{ $kurirClass }}">
                                                {{ $order->kurir }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            @php
                                                $metodeColors = [
                                                    'COD' => 'bg-yellow-900/30 text-yellow-400',
                                                    'TRANSFER' => 'bg-purple-900/30 text-purple-400',
                                                ];
                                                $metodeClass = $metodeColors[$order->metode] ?? 'bg-gray-700 text-gray-300';
                                            @endphp
                                            <span class="px-3 py-1.5 uppercase inline-flex text-xs leading-5 font-bold rounded-lg {{ $metodeClass }}">
                                                {{ $order->metode }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            @php
                                                $statusColors = [
                                                    'Pending' => 'bg-yellow-900/30 text-yellow-400',
                                                    'Processed' => 'bg-blue-900/30 text-blue-400',
                                                    'Canceled' => 'bg-red-900/30 text-red-400',
                                                    'Confirmed' => 'bg-green-900/30 text-green-400',
                                                    'Sending' => 'bg-orange-900/30 text-orange-400',
                                                    'Delivered' => 'bg-green-900/30 text-green-400',
                                                ];
                                                $statusClass = $statusColors[$order->status] ?? 'bg-gray-700 text-gray-300';
                                            @endphp
                                            <span class="px-3 py-1.5 uppercase inline-flex text-xs leading-5 font-bold rounded-lg {{ $statusClass }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center text-green-400 font-semibold">
                                            Rp {{ number_format((int) $order->total_harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('User.show', $order->id) }}"
                                                class="inline-flex items-center gap-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-xs font-semibold px-3 py-2 rounded-lg transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" />
                                                </svg>
                                                Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>