<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-white mb-3 tracking-tight">Detail Produk</h1>
                <p class="text-gray-400 max-w-md mx-auto">Informasi lengkap tentang produk Anda</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Bagian gambar produk -->
                <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8 flex flex-col justify-center items-center">
                    @if($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}" 
                             alt="{{ $produk->nama }}" 
                             class="max-h-96 w-full object-contain rounded-xl shadow-lg border border-gray-700">
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
                
                <!-- Bagian informasi produk -->
                <div class="space-y-8">
                    <!-- Informasi dasar -->
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8">
                        <h2 class="text-3xl font-bold text-white mb-4">{{ $produk->nama }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ $produk->deskripsi ?? 'Tidak ada deskripsi produk.' }}</p>
                    </div>
                    
                    <!-- Detail produk -->
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8">
                        <h3 class="text-xl font-semibold text-white mb-6 pb-3 border-b border-gray-700">Detail Produk</h3>
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-5">
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Harga</span>
                                    <span class="text-xl font-bold text-green-500 mt-1">
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Status Produk</span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1 {{ $produk->status === 'Aktif' ? 'bg-green-900/30 text-green-400' : 'bg-red-900/30 text-red-400' }}">
                                        <span class="w-2 h-2 rounded-full {{ $produk->status === 'Aktif' ? 'bg-green-500' : 'bg-red-500' }} mr-2"></span>
                                        {{ $produk->status }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="space-y-5">
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Stok Tersedia</span>
                                    <span class="text-xl font-semibold text-gray-200 mt-1">
                                        {{ $produk->stok }} item
                                    </span>
                                </div>
                                
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">ID Produk</span>
                                    <span class="text-gray-300 font-mono mt-1">#{{ $produk->id }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 pt-6 border-t border-gray-700">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Ditambahkan</span>
                                    <span class="text-gray-300 mt-1">
                                        {{ $produk->created_at->format('d M Y H:i') }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Diperbarui</span>
                                    <span class="text-gray-300 mt-1">
                                        {{ $produk->updated_at->format('d M Y H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>