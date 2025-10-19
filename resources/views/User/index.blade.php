<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Daftar Barang') }}
        </h2>
    </x-slot>

    <!-- Bagian sambutan -->
    <div class="p-10 rounded-2xl shadow-xl m-10  border border-gray-700 bg-gradient-to-br from-gray-800 to-gray-900">
            <div class=" flex-row justify-between">
                <div class="text-white text-center">
                    <h1 class="font-bold text-3xl text-white bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500">
                        Kelola Pesanan Anda, {{ Auth::user()->name }}!</h1>
                    <p class="text-center text-2xl text-gray-300 mt-2">
                        Kelola Pesanan Anda dengan mudah di sini.</p>
                </div>
            </div>
        </div>
    

    <!-- Bagian Tabel Pesanan -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
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
                        <table class="min-w-full text-sm divide-y divide-gray-700">
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
                                        @php
                                            $metodeColors = [
                                                'JNT' => 'bg-yellow-500 text-white',
                                                'POS' => 'bg-blue-500 text-white',
                                                'JNE' => 'bg-purple-500 text-white',
                                            ];
                                            $metodeClass = $metodeColors[$order->kurir] ?? 'bg-gray-700 text-gray-300';
                                        @endphp
                                        <td class="px-4 py-3 text-center">
                                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $metodeClass }}">
                                                {{ $order->kurir }}
                                            </span>
                                        </td>
                                        {{-- Warna berbeda untuk metode --}}
                                        @php
                                            $metodeColors = [
                                                'COD' => 'bg-yellow-500 text-white',
                                                'TRANSFER' => 'bg-blue-500 text-white',
                                            ];
                                            $metodeClass = $metodeColors[$order->metode] ?? 'bg-gray-700 text-gray-300';
                                        @endphp
                                        <td class="px-4 py-3 text-center">
                                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $metodeClass }}">
                                                {{ $order->metode }}
                                            </span>
                                        </td>

                                        {{-- Status dengan warna --}}
                                        {{-- Warna berbeda untuk metode --}}
                                        @php
                                            $statusColors = [
                                                'Pending' => 'bg-yellow-500 text-white',
                                                'Processed' => 'bg-blue-500 text-white',
                                                'Canceled' => 'bg-red-500 text-white',
                                                'Confirmed' => 'bg-green-500 text-white',
                                                'Sending' => 'bg-orange-500 text-white',
                                                'Delivered' => 'bg-green-500 text-white',
                                            ];
                                            $statusClass = $statusColors[$order->status] ?? 'bg-gray-700 text-gray-300';
                                        @endphp
                                        <td class="px-4 py-3 text-center">
                                            <span
                                                class="px-2 py-1 rounded-full uppercase text-xs font-medium {{ $statusClass }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-3 text-center text-green-400 font-semibold">
                                            Rp {{ number_format((int) $order->total_harga, 0, ',', '.') }}
                                        </td>

                                        {{-- Tombol Detail --}}
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