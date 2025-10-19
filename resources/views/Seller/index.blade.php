<x-app-layout>
    <div class="pt-[150px] pb-[50px] p-6">
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

        <div class="p-10 animate-fadeIn rounded-2xl shadow-xl border border-gray-700 bg-gradient-to-br from-gray-800 to-gray-900">
            <div class="flex flex-row justify-between">
                <div class="text-white">
                    <h1 class="font-bold text-3xl text-white bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500">
                        Kelola Produk</h1>
                    <p class="text-center text-2xl text-gray-300 mt-2">
                        Kelola produk Anda dengan mudah di sini.</p>
                </div>
                <a href="Seller/produk/create"
                    class="rounded-xl inline-flex uppercase font-bold justify-center items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-center text-xl hover:from-indigo-700 hover:to-purple-700 transition">
                    Tambah Produk
                </a>
            </div>
        </div>

    </div>
    <section class="animate-fadeIn -mt-6">
    <div class="max-w-screen-full mx-6">
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-6 border border-gray-700">
            <h1
                class="text-center text-3xl font-extrabold mb-6 text-white bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500">
                Daftar Produk
            </h1>

            @if($produk->count() > 0)
                <div class="overflow-x-auto rounded-xl">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">NO</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">GAMBAR</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">NAMA</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">STOCK</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">HARGA</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">STATUS</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">DETAILS</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-300 uppercase tracking-wider">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @foreach ($produk as $p)
                                <tr class="hover:bg-gray-750 transition">
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-200">{{ $loop->iteration }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        @if($p['gambar'])
                                            <img src="{{ asset('storage/' . $p['gambar']) }}" alt=""
                                                class="w-20 h-20 object-cover rounded-xl mb-3 border border-gray-600 mx-auto">
                                        @else
                                            <div class="w-20 h-20 flex items-center justify-center bg-gray-700 text-gray-400 rounded-xl mx-auto">
                                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-200">{{ $p['nama'] }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="text-sm text-gray-300">{{ $p['stok'] }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div class="text-sm font-semibold text-green-400">
                                            Rp. {{ number_format($p->harga, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap animate-wiggle">
                                        <span class="px-3 py-1.5 uppercase inline-flex text-xs leading-5 font-bold rounded-lg
                                                @if($p['status'] === 'Aktif') bg-green-500 text-white
                                                @else bg-red-500 text-white
                                                @endif">
                                            {{ $p['status'] }}
                                        </span>
                                    </td>
                                    <td class="px-2 py-3 uppercase text-center">
                                        <a href="{{ route('produk.show', $p->id) }}"
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
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <div x-data="{ open: false }" class="relative inline-block text-left">
                                            <button @click="open = !open"
                                                class="p-2 rounded-lg bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-600 hover:to-gray-700 text-gray-300 focus:outline-none transition-all duration-200 transform hover:scale-105 shadow-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" 
                                                    class="h-5 w-5" fill="none" viewBox="0 0 24 24" 
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                                        stroke-width="2" 
                                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" 
                                                        stroke-width="2" 
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </button>

                                            <div x-show="open" 
                                                x-transition:enter="transition ease-out duration-100"
                                                x-transition:enter-start="transform opacity-0 scale-95"
                                                x-transition:enter-end="transform opacity-100 scale-100"
                                                x-transition:leave="transition ease-in duration-75"
                                                x-transition:leave-start="transform opacity-100 scale-100"
                                                x-transition:leave-end="transform opacity-0 scale-95"
                                                @click.away="open = false"
                                                class="absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-xl bg-gray-800/95 backdrop-blur-lg shadow-xl ring-1 ring-gray-700 border border-gray-700/50 overflow-hidden">
                                                <div class="py-1">
                                                    <a href="{{ route('produk.edit', $p->id) }}"
                                                        class="flex items-center px-4 py-3 text-sm text-gray-300 hover:bg-gradient-to-r from-indigo-600/20 to-purple-600/20 hover:text-white transition-all duration-200 group">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3 text-indigo-400 group-hover:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </a>

                                                    <form id="deleteForm-{{ $p->id }}" action="{{ route('produk.destroy', $p->id) }}" method="POST" class="block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete({{ $p->id }}, '{{ addslashes($p->nama) }}')"
                                                            class="w-full flex items-center px-4 py-3 text-sm text-gray-300 hover:bg-gradient-to-r from-red-600/20 to-pink-600/20 hover:text-white transition-all duration-200 group">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-3 text-red-400 group-hover:text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-10">
                    <p class="text-gray-400">Tidak ada produk ditemukan.</p>
                </div>
            @endif
        </div>
    </div>
    </section>
    
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
                <p class="text-gray-400 mt-2"><span id="productName"></span></p>
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
        let deleteProductId = null;
        
        function confirmDelete(productId, productName) {
            deleteProductId = productId;
            document.getElementById('productName').textContent = `Apakah Anda yakin ingin menghapus produk "${productName}"?`;
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
            if (deleteProductId) {
                document.getElementById('deleteForm-' + deleteProductId).submit();
            }
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