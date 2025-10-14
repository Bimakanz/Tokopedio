<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">
            <!-- Notifikasi keberhasilan -->
            @if(session('success'))
                <div class="mb-6 px-4 sm:px-0">
                    <div class="bg-green-900/30 border border-green-700 text-green-200 px-6 py-4 rounded-xl flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-white mb-3 tracking-tight">Detail Pesanan</h1>
                <p class="text-gray-400 max-w-md mx-auto">Informasi lengkap tentang pesanan Anda</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Bagian informasi produk -->
                <div class="space-y-8">
                    <!-- Card produk -->
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8">
                        <h2 class="text-3xl font-bold text-white mb-4">{{ $order->produk->nama ?? '-' }}</h2>
                        
                        <div class="flex justify-between items-center mt-6">
                            <div class="flex flex-col">
                                <span class="text-gray-400 font-medium">Total Harga</span>
                                <span class="text-2xl font-bold text-green-500 mt-1">
                                    Rp {{ number_format((int) $order->total_harga, 0, ',', '.') }}
                                </span>
                            </div>
                            
                            <div class="flex flex-col text-right">
                                <span class="text-gray-400 font-medium">Jumlah Barang</span>
                                <span class="text-xl font-semibold text-gray-200 mt-1">
                                    {{ $order->jumlah }} item
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card detail pesanan -->
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8">
                        <h3 class="text-xl font-semibold text-white mb-6 pb-3 border-b border-gray-700">Detail Pesanan</h3>
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-5">
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Nama Pemesan</span>
                                    <span class="text-gray-200 font-medium mt-1">
                                        {{ $order->nama_pemesan }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Alamat</span>
                                    <span class="text-gray-200 font-medium mt-1">
                                        {{ $order->alamat }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="space-y-5">
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Metode Pembayaran</span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1
                                        @if($order->metode === 'COD') bg-yellow-900/30 text-yellow-400
                                        @elseif($order->metode === 'TRANSFER') bg-purple-900/30 text-purple-400
                                        @else bg-gray-700 text-gray-300 @endif">
                                        {{ $order->metode }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Kurir Pengiriman</span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1
                                        @if($order->kurir === 'JNE') bg-yellow-900/30 text-yellow-400
                                        @elseif($order->kurir === 'JNT') bg-indigo-900/30 text-indigo-400
                                        @elseif($order->kurir === 'POS') bg-blue-900/30 text-blue-400
                                        @else bg-gray-700 text-gray-300 @endif">
                                        {{ $order->kurir }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Bagian gambar produk dan status -->
                <div class="space-y-8">
                    <!-- Card gambar produk -->
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8 flex flex-col justify-center items-center">
                        @if($order->produk && $order->produk->gambar)
                            <img src="{{ asset('storage/' . $order->produk->gambar) }}" 
                                alt="{{ $order->produk->nama }}"
                                class="max-h-80 w-full object-contain rounded-xl shadow-lg border border-gray-700">
                        @else
                            <div class="w-full h-80 flex items-center justify-center bg-gray-900/50 border-2 border-dashed border-gray-700 rounded-xl">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="mt-4 text-gray-500 font-medium">Tidak ada gambar produk</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Card status -->
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8">
                        <h3 class="text-xl font-semibold text-white mb-6 pb-3 border-b border-gray-700">Status Pesanan</h3>
                        
                        <div class="flex justify-center mb-6">
                            <span class="inline-flex items-center px-5 py-2 rounded-full text-lg font-bold
                                @if($order->status === 'Pending') bg-yellow-900/30 text-yellow-400
                                @elseif($order->status === 'Processed') bg-blue-900/30 text-blue-400
                                @elseif($order->status === 'Sending') bg-orange-900/30 text-orange-400
                                @elseif($order->status === 'Confirmed') bg-green-900/30 text-green-400
                                @elseif($order->status === 'Canceled') bg-red-900/30 text-red-400
                                @else bg-gray-700 text-gray-300 @endif">
                                {{ $order->status }}
                            </span>
                        </div>
                        
                        <!-- Ubah Status (for sellers) -->
                        @if(auth()->user()->role === 'Seller')
                        <div class="mt-8 pt-6 border-t border-gray-700">
                            <h4 class="text-lg font-semibold text-white mb-4">Ubah Status Pesanan</h4>
                            <form action="{{ route('Pemesanan.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <select name="status" class="flex-1 bg-gray-700 text-white rounded-xl border border-gray-600 py-3 px-4 focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:outline-none transition duration-200">
                                        <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Processed" {{ $order->status == 'Processed' ? 'selected' : '' }}>Processed</option>
                                        <option value="Sending" {{ $order->status == 'Sending' ? 'selected' : '' }}>Sending</option>
                                        <option value="Confirmed" {{ $order->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="Canceled" {{ $order->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                                    </select>
                                    <button type="submit" class="px-6 py-3 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium shadow-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200">
                                        Perbarui
                                    </button>
                                    <div class="mt-3 text-center">
                                        <a href="{{ route('Pemesanan.index') }}" class="px-6 py-3 rounded-xl bg-gray-700 text-white font-medium shadow-lg hover:bg-gray-600 transition-all duration-200">
                                            Kembali
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>