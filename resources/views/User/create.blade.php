<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            FORM PEMBELIAN
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 space-y-6">
            
            <!-- Produk Info -->
            <div class="mb-6 text-center">
                <h3 class="text-2xl text-white font-bold text-gray-800 mb-2">{{ $produk->nama }}</h3>
                <p class="text-green-600 font-extrabold text-lg">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                </p>
                <img src="{{ asset('storage/' . $produk->gambar) }}" 
                     alt="{{ $produk->nama }}" 
                     class="w-full h-56 rounded-full object-contain rounded-lg mt-3">
            </div>

            <!-- Form -->
            <form action="{{ route('User.store') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <!-- Nama Pembeli -->
                <div>
                    <label class="block text-white font-semibold text-gray-700 mb-1">Nama Pembeli</label>
                    <input type="text" name="nama_pemesan" id="nama_pemesan" value="{{ Auth::user()->name }}"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('nama_pemesan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stok Produk -->
                <div>
                    <label class="block text-white font-semibold text-gray-700 mb-1">Stok Tersedia</label>
                    <p class="text-green-400 bg-gray-800 border border-gray-600 rounded-lg px-3 py-2">
                        {{ $produk->stok }} Barang
                    </p>
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-white font-semibold text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" rows="3"
                        class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jumlah Barang -->
                <div>
                    <label class="block text-white font-semibold text-gray-700 mb-1">Jumlah Barang</label>
                    <input type="text" name="jumlah" id="jumlah" min="1" max="{{ $produk->stok }}" value="1"
                        class="w-full p-2 px-4 bg-gray-800 text-white border border-gray-600 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('jumlah')
                        <p class="text-red-500 p-2 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Total Harga -->
                <div>
                    <label class="block text-white font-semibold text-gray-700 mb-1">Total Harga</label>
                    <p id="total_harga" class="text-green-400 bg-gray-800 border border-gray-600 rounded-lg px-3 py-2 font-bold">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Metode Pembayaran -->
                <div>
                    <label class="block text-white font-semibold text-gray-700 mb-1">Metode Pembayaran</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <label class="payment-option {{ old('metode') == 'COD' ? 'bg-violet-700 text-white border-violet-500' : 'bg-gray-700 text-gray-200' }} flex items-center p-3 rounded-lg border cursor-pointer transition-all duration-200 hover:bg-gray-600">
                            <input type="radio" name="metode" value="COD"
                                {{ old('metode') == 'COD' ? 'checked' : '' }}
                                class="sr-only payment-radio">
                            <span class="ml-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                COD (Bayar di Tempat)
                            </span>
                        </label>

                        <label class="payment-option {{ old('metode') == 'TRANSFER' ? 'bg-violet-700 text-white border-violet-500' : 'bg-gray-700 text-gray-200' }} flex items-center p-3 rounded-lg border cursor-pointer transition-all duration-200 hover:bg-gray-600">
                            <input type="radio" name="metode" value="TRANSFER"
                                {{ old('metode') == 'TRANSFER' ? 'checked' : '' }}
                                class="sr-only payment-radio">
                            <span class="ml-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Transfer Bank
                            </span>
                        </label>
                    </div>
                    @error('metode')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kurir -->
                <div>
                    <label class="block text-white font-semibold text-gray-700 mb-1">Kurir</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <label class="shipping-option {{ old('kurir') == 'JNE' ? 'bg-violet-700 text-white border-violet-500' : 'bg-gray-700 text-gray-200' }} flex flex-col items-center justify-center p-4 rounded-lg border cursor-pointer transition-all duration-200 hover:bg-gray-600 text-center">
                            <input type="radio" name="kurir" value="JNE"
                                {{ old('kurir') == 'JNE' ? 'checked' : '' }}
                                class="sr-only shipping-radio">
                            <div class="flex flex-col items-center">
                                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                <span>JNE</span>
                            </div>
                        </label>

                        <label class="shipping-option {{ old('kurir') == 'JNT' ? 'bg-violet-700 text-white border-violet-500' : 'bg-gray-700 text-gray-200' }} flex flex-col items-center justify-center p-4 rounded-lg border cursor-pointer transition-all duration-200 hover:bg-gray-600 text-center">
                            <input type="radio" name="kurir" value="JNT"
                                {{ old('kurir') == 'JNT' ? 'checked' : '' }}
                                class="sr-only shipping-radio">
                            <div class="flex flex-col items-center">
                                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span>JNT</span>
                            </div>
                        </label>

                        <label class="shipping-option {{ old('kurir') == 'POS' ? 'bg-violet-700 text-white border-violet-500' : 'bg-gray-700 text-gray-200' }} flex flex-col items-center justify-center p-4 rounded-lg border cursor-pointer transition-all duration-200 hover:bg-gray-600 text-center">
                            <input type="radio" name="kurir" value="POS"
                                {{ old('kurir') == 'POS' ? 'checked' : '' }}
                                class="sr-only shipping-radio">
                            <div class="flex flex-col items-center">
                                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>POS</span>
                            </div>
                        </label>
                    </div>
                    @error('kurir')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full shadow-lg text-center bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl py-3 transition transform hover:scale-105">
                        💰 Beli Sekarang
                    </button>
                </div>
            </form>
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
                const total = hargaSatuan * jumlah;
                totalHarga.textContent = 'Rp ' + total.toLocaleString('id-ID');
            });

            // Payment method selection
            const paymentRadios = document.querySelectorAll('.payment-radio');
            paymentRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Remove selected classes from all payment options
                    document.querySelectorAll('.payment-option').forEach(option => {
                        option.classList.remove('bg-violet-700', 'text-white', 'border-violet-500');
                        option.classList.add('bg-gray-700', 'text-gray-200');
                    });
                    
                    // Add selected classes to the checked option
                    const selectedLabel = this.closest('.payment-option');
                    selectedLabel.classList.remove('bg-gray-700', 'text-gray-200');
                    selectedLabel.classList.add('bg-violet-700', 'text-white', 'border-violet-500');
                });
            });

            // Shipping method selection
            const shippingRadios = document.querySelectorAll('.shipping-radio');
            shippingRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    // Remove selected classes from all shipping options
                    document.querySelectorAll('.shipping-option').forEach(option => {
                        option.classList.remove('bg-violet-700', 'text-white', 'border-violet-500');
                        option.classList.add('bg-gray-700', 'text-gray-200');
                    });
                    
                    // Add selected classes to the checked option
                    const selectedLabel = this.closest('.shipping-option');
                    selectedLabel.classList.remove('bg-gray-700', 'text-gray-200');
                    selectedLabel.classList.add('bg-violet-700', 'text-white', 'border-violet-500');
                });
            });
        });
    </script>
</x-app-layout>
