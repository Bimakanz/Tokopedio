<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Bagian sambutan -->
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Ini adalah halaman Pesanan , {{ Auth::user()->name }} !
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Tabel Pesanan -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-12">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($orders->isEmpty())
                    <div class="p-4 bg-white dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700">
                        Belum ada pesanan.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100 dark:bg-gray-700 dark:text-gray-100">
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
                            <tbody>
                                @foreach($orders as $order)
                                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 text-center">{{ $order->produk->nama ?? '—' }}</td>
                                        <td class="px-4 py-3 text-center">{{ $order->jumlah }}</td>
                                            @php
                                            $metodeColors = [
                                                'JNT' => 'bg-yellow-500 text-white',
                                                'POS' => 'bg-blue-500 text-white',
                                                'JNE' => 'bg-purple-500 text-white',
                                            ];
                                            $metodeClass = $metodeColors[$order->kurir] ?? 'bg-gray-100 text-gray-700';
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
                                                'Transfer Bank' => 'bg-blue-500 text-white',
                                            ];
                                            $metodeClass = $metodeColors[$order->metode] ?? 'bg-gray-100 text-gray-700';
                                        @endphp
                                        <td class="px-4 py-3 text-center">
                                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $metodeClass }}">
                                                {{ $order->metode }}
                                            </span>
                                        </td>

                                        {{-- Status dengan warna --}}
                                       {{-- Warna berbeda untuk metode --}}
                                        @php
                                            $metodeColors = [
                                                'Pending' => 'bg-yellow-500 text-white',
                                                'Processed' => 'bg-blue-500 text-white',
                                                'Cancel' => 'bg-red-500 text-white',
                                                'Confirmed' => 'bg-green-500 text-white',
                                                'Sending' => 'bg-orange-500 text-white',
                                                'Delivered' => 'bg-green-500 text-white',
                                            ];
                                            $metodeClass = $metodeColors[$order->status] ?? 'bg-gray-100 text-gray-700';
                                        @endphp
                                        <td class="px-4 py-3 text-center">
                                            <span class="px-2 py-1 rounded-full uppercase text-xs font-medium {{ $metodeClass }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-3 text-center">
                                            Rp {{ number_format((int)$order->total_harga,0,',','.') }}
                                        </td>

                                        {{-- Tombol Detail --}}
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('User.show', $order->id) }}"
                                                class="inline-flex items-center gap-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-3 py-2 rounded-lg transition">
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
