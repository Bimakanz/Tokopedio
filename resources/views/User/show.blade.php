<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-4 sm:px-6 animate-fadeIn pt-[150px]">
        <div class="max-w-6xl mx-auto animate-fadeIn">
            <div class="text-center mb-10 animate-fadeIn">
                <h1 class="text-4xl font-extrabold text-white mb-3 tracking-tight">Detail Pesanan Anda</h1>
                <p class="text-gray-400 max-w-md mx-auto">Informasi lengkap tentang pesanan Anda</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fadeIn">
                <!-- Bagian informasi produk -->
                <div class="space-y-8 animate-fadeIn">
                    <!-- Card produk -->
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8 animate-fadeIn">
                        <h2 class="text-3xl font-bold text-white mb-4">{{ $produk->nama ?? '-' }}</h2>
                        
                        <div class="flex justify-between items-center mt-6">
                            <div class="flex flex-col">
                                <span class="text-gray-400 font-medium">Total Harga</span>
                                <span class="text-2xl font-bold text-green-500 mt-1">
                                    Rp {{ number_format((int) $orders->total_harga, 0, ',', '.') }}
                                </span>
                            </div>
                            
                            <div class="flex flex-col text-right">
                                <span class="text-gray-400 font-medium">Jumlah Barang</span>
                                <span class="text-xl font-semibold text-gray-200 mt-1">
                                    {{ $orders->jumlah }} item
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
                                        {{ $orders->nama_pemesan }}
                                    </span>
                                </div>
                                
                                <div class="flex text-wrap flex-col">
                                    <span class="text-gray-400 font-medium">Alamat</span>
                                    <span class="text-gray-200 font-medium mt-1 break-words whitespace-normal">
                                        {{ $orders->alamat }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="space-y-5">
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Metode Pembayaran</span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1
                                        @if($orders->metode === 'COD') bg-yellow-900/30 text-yellow-400
                                        @elseif($orders->metode === 'TRANSFER') bg-purple-900/30 text-purple-400
                                        @else bg-gray-700 text-gray-300 @endif">
                                        {{ $orders->metode }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Kurir Pengiriman</span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1
                                        @if($orders->kurir === 'JNE') bg-yellow-900/30 text-yellow-400
                                        @elseif($orders->kurir === 'JNT') bg-indigo-900/30 text-indigo-400
                                        @elseif($orders->kurir === 'POS') bg-blue-900/30 text-blue-400
                                        @else bg-gray-700 text-gray-300 @endif">
                                        {{ $orders->kurir }}
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
                    @if($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" 
                             alt="{{ $produk->nama }}" 
                             class="max-h-96 w-full object-contain rounded-xl shadow-lg border border-gray-700 transform transition duration-500 hover:scale-105">
                    @else
                        <div class="w-full h-96 flex items-center justify-center bg-gray-900/50 border-2 border-dashed border-gray-700 rounded-xl">
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
                                @if($orders->status === 'Pending') bg-yellow-900/30 text-yellow-400
                                @elseif($orders->status === 'Processed') bg-blue-900/30 text-blue-400
                                @elseif($orders->status === 'Sending') bg-orange-900/30 text-orange-400
                                @elseif($orders->status === 'Confirmed') bg-green-900/30 text-green-400
                                @elseif($orders->status === 'Canceled') bg-red-900/30 text-red-400
                                @else bg-gray-700 text-gray-300 @endif">
                                {{ $orders->status }}
                            </span>
                        </div>
                        
                        <div class="mt-8 pt-6 border-t border-gray-700 text-center">
                            <a href="{{ route('User.index') }}" class="px-6 py-3 rounded-xl bg-gray-700 text-white font-medium shadow-lg hover:bg-gray-600 transition-all duration-200 inline-block">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>