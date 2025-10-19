<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-4 sm:px-6 pt-[150px] animate-fadeIn">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-white mb-3 tracking-tight animate-fadeIn">Detail Produk</h1>
                <p class="text-gray-400 max-w-md mx-auto animate-fadeIn">Informasi lengkap tentang produk Anda</p>
            </div>
            
            <div class="flex justify-end mb-6 animate-fadeIn">
                <div class="flex space-x-3">
                    <a href="{{ route('produk.edit', $produk->id) }}" class="px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium shadow hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 flex items-center transform hover:scale-105 animate-pulseScale">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit
                    </a>
                    
                    <form id="deleteForm" action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete()" class="px-4 py-2 rounded-lg bg-gradient-to-r from-red-600 to-pink-600 text-white font-medium shadow hover:from-red-700 hover:to-pink-700 transition-all duration-200 flex items-center transform hover:scale-105 animate-pulseScale">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fadeIn">
                <!-- Bagian gambar produk -->
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
                
                <!-- Bagian informasi produk -->
                <div class="space-y-8 animate-fadeIn">
                    <!-- Informasi dasar -->
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8 transform transition duration-500 hover:scale-[1.01]">
                        <h2 class="text-3xl font-bold text-white mb-4">{{ $produk->nama }}</h2>
                        <p class="text-gray-300 leading-relaxed">{{ $produk->deskripsi ?? 'Tidak ada deskripsi produk.' }}</p>
                    </div>
                    
                    <!-- Detail produk -->
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8 transform transition duration-500 hover:scale-[1.01]">
                        <h3 class="text-xl font-semibold text-white mb-6 pb-3 border-b border-gray-700">Detail Produk</h3>
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-5">
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Harga</span>
                                    <span id="harga" class="text-xl font-bold text-green-500 mt-1 animate-pulseScale">
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                    </span>
                                </div>
                                
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Status Produk</span>
                                    <span id="statusBadge" class="inline-flex uppercase items-center px-3 py-1 rounded-full text-sm font-medium mt-1 {{ $produk->status === 'Aktif' ? 'bg-green-900/30 text-green-400' : 'bg-red-900/30 text-red-400' }} animate-pulseScale">
                                        <span class="w-2 h-2 uppercase rounded-full {{ $produk->status === 'Aktif' ? 'bg-green-500' : 'bg-red-500' }} mr-2"></span>
                                        {{ $produk->status }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="space-y-5">
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">Stok Tersedia</span>
                                    <span id="stok" class="text-xl font-semibold text-gray-200 mt-1 animate-pulseScale">
                                        {{ $produk->stok }} item
                                    </span>
                                </div>
                                
                                <div class="flex flex-col">
                                    <span class="text-gray-400 font-medium">ID Produk</span>
                                    <span class="text-gray-300 font-mono mt-1">#{{ $produk->id }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Confirmation modal -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-gray-800 rounded-2xl p-8 max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0 animate-modalShow">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-900/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mt-4">Konfirmasi Hapus</h3>
                <p class="text-gray-400 mt-2">Apakah Anda yakin ingin menghapus produk "{{ $produk->nama }}"?</p>
                <p class="text-gray-500 text-sm mt-1">Tindakan ini tidak dapat dibatalkan.</p>
                <div class="mt-6 flex justify-center space-x-4">
                    <button onclick="cancelDelete()" class="px-6 py-2 rounded-lg bg-gray-700 text-white font-medium transition-all duration-200 transform hover:scale-105">
                        Batal
                    </button>
                    <button onclick="performDelete()" class="px-6 py-2 rounded-lg bg-gradient-to-r from-red-600 to-pink-600 text-white font-medium transition-all duration-200 transform hover:scale-105">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function confirmDelete() {
            document.getElementById('confirmModal').classList.remove('hidden');
            setTimeout(() => {
                document.querySelector('#confirmModal .transform').classList.remove('scale-95', 'opacity-0');
                document.querySelector('#confirmModal .transform').classList.add('scale-100', 'opacity-100');
            }, 10);
        }
        
        function cancelDelete() {
            const modal = document.getElementById('confirmModal');
            document.querySelector('#confirmModal .transform').classList.remove('scale-100', 'opacity-100');
            document.querySelector('#confirmModal .transform').classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }
        
        function performDelete() {
            document.getElementById('deleteForm').submit();
        }
        
        // Close modal when clicking outside
        document.getElementById('confirmModal').addEventListener('click', function(e) {
            if (e.target === this) {
                cancelDelete();
            }
        });
        
        // Add keyboard support
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cancelDelete();
            }
        });
    </script>
    
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulseScale {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
        }
        
        @keyframes modalShow {
            0% { transform: scale(0.95); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .animate-fadeIn {
            animation: fadeIn 0.6s ease-out;
        }
        
        .animate-pulseScale {
            animation: pulseScale 2s infinite;
        }
        
        .animate-modalShow {
            animation: modalShow 0.3s ease-out forwards;
        }
    </style>
</x-app-layout>