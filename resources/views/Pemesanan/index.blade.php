<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Daftar pesanan mu, ') . Auth::user()->name . ' !' }}
        </h2>
    </x-slot>
    <div class="p-8">
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
        
        <div class="p-10 rounded-2xl shadow-xl mt-5 border border-gray-700 bg-gradient-to-br from-gray-800 to-gray-900">
            <div class="flex flex-row justify-between">
                <div class="text-white">
                    <h1 class="font-bold text-3xl text-white bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500">
                        Kelola Produk</h1>
                    <p class="text-center text-2xl text-gray-300 mt-2">
                        Kelola produk Anda dengan mudah di sini.</p>
                </div>
            </div>
        </div>

    </div>
    <section class="">
    <div class="max-w-screen-full mx-12">
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-8 border border-gray-700">
            <h1
                class="text-center text-3xl font-extrabold mb-8 text-white bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500">
                Daftar Pesanan
            </h1>

            @if($orders->count() > 0)
                <div class="overflow-x-auto rounded-xl">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    No</th>
                                <th scope="col"
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Produk</th>
                                <th scope="col"
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Nama Pemesan</th>
                                <th scope="col"
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Jumlah</th>
                                <th scope="col"
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Total Harga</th>
                                <th scope="col"
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Kurir</th>
                                <th scope="col"
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Metode</th>
                                <th scope="col"
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col"
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Aksi</th>
                                <th scope="col"
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Detail</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @foreach($orders as $order)
                                <tr class="hover:bg-gray-750 transition">
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-200">{{ $loop->iteration }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-200">{{ $order->produk->nama ?? '-' }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <div class="text-sm text-gray-200">{{ $order->nama_pemesan }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <div class="text-sm text-gray-200">{{ $order->jumlah }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <div class="text-sm font-semibold text-green-400">
                                            Rp {{ number_format((int) $order->total_harga, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($order->kurir == 'JNE') bg-yellow-500 text-white
                                                @elseif($order->kurir == 'JNT') bg-indigo-500 text-white
                                                @else bg-blue-500 text-white
                                                @endif">
                                            {{ $order->kurir }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($order->metode == 'COD') bg-yellow-500 text-white
                                                @else bg-purple-500 text-white
                                                @endif">
                                            {{ $order->metode }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <span class="px-2 uppercase inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($order->status == 'Pending') bg-yellow-500 text-white
                                                @elseif($order->status == 'Processed') bg-indigo-500 text-white
                                                @elseif($order->status == 'Confirmed') bg-green-500 text-white
                                                @elseif($order->status == 'Sending') bg-orange-500 text-white
                                                @else bg-red-500 text-white
                                                @endif">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap text-sm">
                                        @if(auth()->user()->role === 'Seller')
                                            <form action="{{ route('Pemesanan.updateStatus', $order->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('PUT')
                                                <select name="status"
                                                    class="text-left uppercase rounded-lg bg-gray-700 border-gray-600 text-gray-200 text-xs p-2">
                                                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="Processed" {{ $order->status == 'Processed' ? 'selected' : '' }}>
                                                        Processed</option>
                                                    <option value="Sending" {{ $order->status == 'Sending' ? 'selected' : '' }}>
                                                        Sending</option>
                                                    <option value="Canceled" {{ $order->status == 'Canceled' ? 'selected' : '' }}>
                                                        Canceled</option>
                                                    <option value="Confirmed" {{ $order->status == 'Confirmed' ? 'selected' : '' }}>
                                                        Confirmed</option>
                                                </select>
                                                <button type="submit"
                                                    class="ml-1 uppercase bg-indigo-600 text-white p-2 rounded text-xs hover:bg-indigo-700">
                                                    Ubah
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="px-2 py-3 uppercase text-center">
                                        <a href="{{ route('Pemesanan.show', $order->id) }}"
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
            @else
                <div class="text-center py-10">
                    <p class="text-gray-400">Tidak ada pesanan ditemukan.</p>
                </div>
            @endif
        </div>
    </div>
    </section>
</x-app-layout>