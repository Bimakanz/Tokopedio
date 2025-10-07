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
                     class="w-full h-56 object-contain rounded-lg mt-3">
            </div>

            <!-- Form -->
            <form action="{{ route('User.store') }}" method="POST" class="space-y-5">
                @csrf

                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <input type="hidden" name="nama_pemesan" value="{{ Auth::user()->name }}">

                <!-- Nama Pembeli -->
                <div>
                    <label class="block text-white font-semibold text-gray-700 mb-1">Nama Pembeli</label>
                    <p class="text-white bg-gray-800 border border-gray-600 rounded-lg px-3 py-2">
                        {{ Auth::user()->name }}
                    </p>
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
                        class="w-full bg-gray-800 text-white border border-gray-600 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jumlah Barang -->
                <div>
                    <label class="block text-white font-semibold text-gray-700 mb-1">Jumlah Barang</label>
                    <input type="number" name="jumlah" id="jumlah" min="1" max="{{ $produk->stok }}" value="1"
                        class="w-full bg-gray-800 text-white border border-gray-600 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('jumlah')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
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
                    <div class="space-y-2">
                        <label class="flex text-white items-center space-x-2">
                            <input type="radio" name="metode" value="COD"
                                {{ old('metode') == 'COD' ? 'checked' : '' }}
                                class="text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <span>COD (Bayar di Tempat)</span>
                        </label>

                        <label class="flex text-white items-center space-x-2">
                            <input type="radio" name="metode" value="TRANSFER"
                                {{ old('metode') == 'TRANSFER' ? 'checked' : '' }}
                                class="text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <span>Transfer Bank</span>
                        </label>
                    </div>
                    @error('metode')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kurir -->
                <div>
                    <label class="block text-white font-semibold text-gray-700 mb-1">Kurir</label>
                    <div class="space-y-2">
                        <label class="flex text-white items-center space-x-2">
                            <input type="radio" name="kurir" value="JNE"
                                {{ old('kurir') == 'JNE' ? 'checked' : '' }}
                                class="text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <span>JNE</span>
                        </label>

                        <label class="flex text-white items-center space-x-2">
                            <input type="radio" name="kurir" value="JNT"
                                {{ old('kurir') == 'JNT' ? 'checked' : '' }}
                                class="text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <span>JNT</span>
                        </label>

                        <label class="flex text-white items-center space-x-2">
                            <input type="radio" name="kurir" value="POS"
                                {{ old('kurir') == 'POS' ? 'checked' : '' }}
                                class="text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <span>POS</span>
                        </label>
                    </div>
                    @error('kurir')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-violet-600 hover:bg-violet-900 text-white font-semibold py-2 rounded-lg transition">
                        💰 Beli Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script untuk update total harga -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const jumlahInput = document.getElementById('jumlah');
            const totalHarga = document.getElementById('total_harga');
            const hargaSatuan = {{ $produk->harga }};

            jumlahInput.addEventListener('input', () => {
                const jumlah = parseInt(jumlahInput.value) || 1;
                const total = hargaSatuan * jumlah;
                totalHarga.textContent = 'Rp ' + total.toLocaleString('id-ID');
            });
        });
    </script>
</x-app-layout>
