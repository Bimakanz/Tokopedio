<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-4 sm:px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-white mb-3 tracking-tight">Edit Produk</h1>
                <p class="text-gray-400 max-w-md mx-auto">Perbarui informasi produk untuk menggantinya di toko Anda</p>
            </div>
            
            <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-6 sm:p-8">
                <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data" id="productForm">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Kolom kiri -->
                        <div class="space-y-6">
                            <div>
                                <label class="block mb-2 text-gray-300 font-semibold" for="nama">Nama Produk</label>
                                <input 
                                    type="text" 
                                    name="nama" 
                                    id="nama" 
                                    value="{{ old('nama', $produk->nama) }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-600 bg-gray-900 text-white focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:outline-none transition duration-200" 
                                    placeholder="Contoh: Kemeja Premium Katun"/>
                                @error('nama')
                                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-gray-300 font-semibold" for="harga">Harga Produk</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                        Rp
                                    </div>
                                    <input 
                                        type="text" 
                                        name="harga" 
                                        id="harga" 
                                        value="{{ old('harga', $produk->harga) }}"
                                        class="w-full pl-10 px-4 py-3 rounded-xl border border-gray-600 bg-gray-900 text-white focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:outline-none transition duration-200" 
                                        placeholder="0"/>
                                </div>
                                @error('harga')
                                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-gray-300 font-semibold" for="stok">Stok Tersedia</label>
                                <input 
                                    type="number" 
                                    name="stok" 
                                    id="stok" 
                                    value="{{ old('stok', $produk->stok) }}"
                                    min="0"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-600 bg-gray-900 text-white focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:outline-none transition duration-200" 
                                    placeholder="Jumlah stok tersedia"/>
                                @error('stok')
                                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-gray-300 font-semibold" for="status">Status Produk</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="flex items-center p-4 rounded-xl border border-gray-600 bg-gray-900 cursor-pointer hover:bg-gray-700 transition duration-200 {{ old('status', $produk->status) == 'Aktif' ? 'ring-2 ring-purple-600 bg-gray-700' : '' }}">
                                        <input type="radio" name="status" value="Aktif" class="form-radio text-purple-600 focus:ring-purple-600 h-5 w-5" {{ old('status', $produk->status) == 'Aktif' ? 'checked' : '' }}>
                                        <span class="ml-3 text-gray-200 font-medium">Aktif</span>
                                    </label>
                                    <label class="flex items-center p-4 rounded-xl border border-gray-600 bg-gray-900 cursor-pointer hover:bg-gray-700 transition duration-200 {{ old('status', $produk->status) == 'Non-aktif' ? 'ring-2 ring-purple-600 bg-gray-700' : '' }}">
                                        <input type="radio" name="status" value="Non-aktif" class="form-radio text-purple-600 focus:ring-purple-600 h-5 w-5" {{ old('status', $produk->status) == 'Non-aktif' ? 'checked' : '' }}>
                                        <span class="ml-3 text-gray-200 font-medium">Non-Aktif</span>
                                    </label>
                                </div>
                                @error('status')
                                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Kolom kanan dengan preview gambar -->
                        <div class="space-y-6">
                            <div>
                                <label class="block mb-2 text-gray-300 font-semibold" for="gambar">Gambar Produk</label>
                                <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-600 rounded-2xl bg-gray-900/50 p-6 transition duration-200 hover:bg-gray-900/70" id="dropArea">
                                    <input type="file" name="gambar" id="gambar" class="hidden" accept="image/*" />
                                    <div class="text-center">
                                        <div class="mx-auto bg-gray-800 p-3 rounded-full w-12 h-12 flex items-center justify-center mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <p class="text-gray-400 mb-2">Klik untuk memilih gambar</p>
                                        <p class="text-gray-500 text-sm">Format: JPG, PNG, maks 2MB</p>
                                    </div>
                                    
                                    <!-- Preview area -->
                                    <div id="imagePreview" class="mt-4 w-full {{ $produk->gambar ? '' : 'hidden' }}">
                                        <div class="relative inline-block">
                                            <img id="previewImage" 
                                                 src="{{ $produk->gambar ? asset('storage/' . $produk->gambar) : '#' }}" 
                                                 alt="Preview Gambar" 
                                                 class="max-h-64 rounded-xl object-contain mx-auto" 
                                                 style="{{ $produk->gambar ? '' : 'display: none;' }}"/>
                                            <button type="button" id="removeImage" class="absolute -top-3 -right-3 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @error('gambar')
                                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-gray-300 font-semibold" for="deskripsi">Deskripsi Produk</label>
                                <textarea 
                                    name="deskripsi" 
                                    id="deskripsi" 
                                    rows="5" 
                                    class="w-full px-4 py-3 rounded-xl border border-gray-600 bg-gray-900 text-white focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:outline-none transition duration-200" 
                                    placeholder="Deskripsikan produk Anda secara detail...">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-10 flex justify-center space-x-4">
                        <a href="{{ route('produk.index') }}" class="px-6 py-3 rounded-lg bg-gray-700 text-white font-medium shadow hover:bg-gray-600 transition-all duration-200">
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-4 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold text-lg shadow-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                            <span class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                </svg>
                                Update Produk
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Script untuk preview gambar -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('gambar');
                const dropArea = document.getElementById('dropArea');
                const imagePreview = document.getElementById('imagePreview');
                const previewImage = document.getElementById('previewImage');
                const removeImageButton = document.getElementById('removeImage');
                
                // Tampilkan file dialog saat area drop diklik
                dropArea.addEventListener('click', function() {
                    fileInput.click();
                });
                
                // Tampilkan preview saat file dipilih
                fileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        
                        reader.onload = function(event) {
                            previewImage.src = event.target.result;
                            imagePreview.classList.remove('hidden');
                            previewImage.style.display = 'block';
                        }
                        
                        reader.readAsDataURL(file);
                    }
                });
                
                // Hapus gambar yang dipilih
                removeImageButton.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                        fileInput.value = '';
                        previewImage.style.display = 'none';
                        imagePreview.classList.add('hidden');
                    }
                });
                
                // Drag & drop functionality
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    dropArea.addEventListener(eventName, preventDefaults, false);
                });
                
                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                
                ['dragenter', 'dragover'].forEach(eventName => {
                    dropArea.addEventListener(eventName, highlight, false);
                });
                
                ['dragleave', 'drop'].forEach(eventName => {
                    dropArea.addEventListener(eventName, unhighlight, false);
                });
                
                function highlight() {
                    dropArea.classList.add('border-purple-500', 'bg-gray-900');
                }
                
                function unhighlight() {
                    dropArea.classList.remove('border-purple-500', 'bg-gray-900');
                }
                
                dropArea.addEventListener('drop', handleDrop, false);
                
                function handleDrop(e) {
                    const dt = e.dataTransfer;
                    const file = dt.files[0];
                    
                    if (file && file.type.startsWith('image/')) {
                        fileInput.files = dt.files;
                        
                        const reader = new FileReader();
                        
                        reader.onload = function(event) {
                            previewImage.src = event.target.result;
                            imagePreview.classList.remove('hidden');
                            previewImage.style.display = 'block';
                        }
                        
                        reader.readAsDataURL(file);
                    }
                }
            });
        </script>
    </div>
</x-app-layout>
