<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-white mb-3 tracking-tight">Formulir Pembelian</h1>
                <p class="text-gray-400 max-w-md mx-auto">Lengkapi informasi pembelian Anda untuk menyelesaikan transaksi</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fadeIn">
                <!-- Bagian gambar produk -->
                <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-10 flex flex-col justify-center items-center">
    @if($produk->gambar)
        <div class="relative overflow-hidden rounded-xl border border-gray-700 shadow-lg group">
            <img src="{{ asset('storage/' . $produk->gambar) }}" 
                 alt="{{ $produk->nama }}" 
                 class="max-h-96 w-full object-contain rounded-xl transition-all duration-700 ease-out group-hover:scale-110 group-hover:rotate-1 group-hover:brightness-110 group-hover:contrast-125">
            
            <!-- overlay gradient lembut pas dihover -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 rounded-xl"></div>
        </div>
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

    <div class="mb-10 mt-[80px] text-center">
        <h2 class="text-5xl font-bold text-white mb-2">{{ $produk->nama }}</h2>
        <p class="text-3xl font-bold text-green-500 mb-2">
            Rp {{ number_format($produk->harga, 0, ',', '.') }}
        </p>
        <div class="flex justify-center items-center gap-4 text-sm">
            <span class="bg-gray-700 uppercase font-bold text-gray-200 px-3 py-1 rounded-full">{{ $produk->stok }} Stok</span>
            <span class="bg-green-900/30 uppercase font-bold text-green-400 px-3 py-1 rounded-full">Tersedia</span>
        </div>
    </div>
</div>

                
                <!-- Bagian form -->
                <div class="space-y-6">
                    <div class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-2xl border border-gray-700 p-8">
                        <form action="{{ route('User.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nama Pembeli -->
                                <div>
                                    <label class="block mb-2 text-gray-300 font-semibold" for="nama_pemesan">Nama Lengkap</label>
                                    <input 
                                        type="text" 
                                        name="nama_pemesan" 
                                        id="nama_pemesan" 
                                        value="{{ Auth::user()->name ?? old('nama_pemesan') }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-600 bg-gray-900 text-white focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:outline-none transition duration-200" 
                                        placeholder="Nama lengkap Anda"/>
                                    @error('nama_pemesan')
                                        <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Jumlah Barang -->
                                <div>
                                    <label class="block mb-2 text-gray-300 font-semibold" for="jumlah">Jumlah Barang</label>
                                    <input 
                                        type="number" 
                                        name="jumlah" 
                                        id="jumlah" 
                                        min="1" 
                                        max="{{ $produk->stok }}" 
                                        value="{{ old('jumlah', 1) }}"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-600 bg-gray-900 text-white focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:outline-none transition duration-200" 
                                        placeholder="Jumlah barang"/>
                                    @error('jumlah')
                                        <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Alamat -->
                            <div>
                                <label class="block mb-2 text-gray-300 font-semibold" for="alamat">Alamat Lengkap</label>
                                <textarea 
                                    name="alamat" 
                                    id="alamat" 
                                    rows="3" 
                                    class="w-full px-4 py-3 rounded-xl border border-gray-600 bg-gray-900 text-white focus:ring-2 focus:ring-purple-600 focus:border-transparent focus:outline-none transition duration-200" 
                                    placeholder="Masukkan alamat lengkap Anda termasuk RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten, dan Kode Pos">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Total Harga -->
                            <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-700">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300 font-semibold">Total Harga:</span>
                                    <span id="total_harga" class="text-2xl font-bold text-green-500">
                                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Metode Pembayaran -->
                            <div>
                                <label class="block mb-2 text-gray-300 font-semibold">Metode Pembayaran</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <label class="payment-option {{ old('metode') == 'COD' ? 'ring-2 ring-purple-600 bg-gray-700' : 'bg-gray-900' }} flex items-center p-4 rounded-xl border border-gray-600 cursor-pointer transition-all duration-200 hover:bg-gray-700">
                                        <input type="radio" name="metode" value="COD"
                                            {{ old('metode') == 'COD' ? 'checked' : '' }}
                                            class="sr-only payment-radio">
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 rounded-full border-2 border-gray-400 flex items-center justify-center mr-3">
                                                <div class="w-3 h-3 rounded-full bg-purple-600 {{ old('metode') == 'COD' ? '' : 'hidden' }}"></div>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-6 h-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                                <span class="text-gray-200">(COD)</span>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="payment-option {{ old('metode') == 'TRANSFER' ? 'ring-2 ring-purple-600 bg-gray-700' : 'bg-gray-900' }} flex items-center p-4 rounded-xl border border-gray-600 cursor-pointer transition-all duration-200 hover:bg-gray-700">
                                        <input type="radio" name="metode" value="TRANSFER"
                                            {{ old('metode') == 'TRANSFER' ? 'checked' : '' }}
                                            class="sr-only payment-radio">
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 rounded-full border-2 border-gray-400 flex items-center justify-center mr-3">
                                                <div class="w-3 h-3 rounded-full bg-purple-600 {{ old('metode') == 'TRANSFER' ? '' : 'hidden' }}"></div>
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-6 h-6 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                                </svg>
                                                <span class="text-gray-200">Transfer</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                @error('metode')
                                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Kurir -->
                            <div>
                                <label class="block mb-2 text-gray-300 font-semibold">Kurir Pengiriman</label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <label class="shipping-option {{ old('kurir') == 'JNE' ? 'ring-2 ring-purple-600 bg-gray-700' : 'bg-gray-900' }} flex flex-col items-center justify-center p-4 rounded-xl border border-gray-600 cursor-pointer transition-all duration-200 hover:bg-gray-700 text-center">
                                        <input type="radio" name="kurir" value="JNE"
                                            {{ old('kurir') == 'JNE' ? 'checked' : '' }}
                                            class="sr-only shipping-radio">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                            <span class="text-gray-200">JNE</span>
                                        </div>
                                    </label>
                                    
                                    <label class="shipping-option {{ old('kurir') == 'JNT' ? 'ring-2 ring-purple-600 bg-gray-700' : 'bg-gray-900' }} flex flex-col items-center justify-center p-4 rounded-xl border border-gray-600 cursor-pointer transition-all duration-200 hover:bg-gray-700 text-center">
                                        <input type="radio" name="kurir" value="JNT"
                                            {{ old('kurir') == 'JNT' ? 'checked' : '' }}
                                            class="sr-only shipping-radio">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                            <span class="text-gray-200">JNT</span>
                                        </div>
                                    </label>
                                    
                                    <label class="shipping-option {{ old('kurir') == 'POS' ? 'ring-2 ring-purple-600 bg-gray-700' : 'bg-gray-900' }} flex flex-col items-center justify-center p-4 rounded-xl border border-gray-600 cursor-pointer transition-all duration-200 hover:bg-gray-700 text-center">
                                        <input type="radio" name="kurir" value="POS"
                                            {{ old('kurir') == 'POS' ? 'checked' : '' }}
                                            class="sr-only shipping-radio">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-8 h-8 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-gray-200">POS</span>
                                        </div>
                                    </label>
                                </div>
                                @error('kurir')
                                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Tombol Submit -->
                            <div class="pt-6">
                                <button type="submit" 
                                        class="w-full px-8 py-4 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold text-lg shadow-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                                    <span class="flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Selesaikan Pembelian
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk update total harga dan pilihan metode -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Update total harga
            const jumlahInput = document.getElementById('jumlah');
            const totalHarga = document.getElementById('total_harga');
            const hargaSatuan = {{ $produk->harga }};

            jumlahInput.addEventListener('input', () => {
                const jumlah = parseInt(jumlahInput.value) || 1;
                const max = {{ $produk->stok }};
                
                if(jumlah > max) {
                    jumlahInput.value = max;
                    alert('Jumlah melebihi stok yang tersedia!');
                }
                
                const nilaiJumlah = parseInt(jumlahInput.value) || 1;
                const total = hargaSatuan * nilaiJumlah;
                totalHarga.textContent = 'Rp ' + total.toLocaleString('id-ID');
            });

            // Payment method selection
            const paymentRadios = document.querySelectorAll('.payment-radio');
            paymentRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Remove selected classes from all payment options
                    document.querySelectorAll('.payment-option').forEach(option => {
                        option.classList.remove('ring-2', 'ring-purple-600', 'bg-gray-700');
                        option.classList.add('bg-gray-900');
                    });
                    
                    // Remove selected indicator from radio buttons
                    document.querySelectorAll('.payment-option .w-3.h-3').forEach(indicator => {
                        indicator.classList.add('hidden');
                    });
                    
                    // Add selected classes to the checked option
                    const selectedLabel = this.closest('.payment-option');
                    selectedLabel.classList.remove('bg-gray-900');
                    selectedLabel.classList.add('ring-2', 'ring-purple-600', 'bg-gray-700');
                    
                    // Show selected indicator for this option
                    selectedLabel.querySelector('.w-3.h-3').classList.remove('hidden');
                });
            });

            // Shipping method selection
            const shippingRadios = document.querySelectorAll('.shipping-radio');
            shippingRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Remove selected classes from all shipping options
                    document.querySelectorAll('.shipping-option').forEach(option => {
                        option.classList.remove('ring-2', 'ring-purple-600', 'bg-gray-700');
                        option.classList.add('bg-gray-900');
                    });
                    
                    // Remove selected indicator from radio buttons
                    document.querySelectorAll('.shipping-option .w-3.h-3').forEach(indicator => {
                        indicator.classList.add('hidden');
                    });
                    
                    // Add selected classes to the checked option
                    const selectedLabel = this.closest('.shipping-option');
                    selectedLabel.classList.remove('bg-gray-900');
                    selectedLabel.classList.add('ring-2', 'ring-purple-600', 'bg-gray-700');
                    
                    // Show selected indicator for this option
                    selectedLabel.querySelector('.w-3.h-3').classList.remove('hidden');
                });
            });
        });
    </script>
</x-app-layout>
