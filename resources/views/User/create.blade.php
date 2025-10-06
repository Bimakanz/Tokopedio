<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Form Penjualan
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8 space-y-6 shadow-md rounded-lg p-8">
            
            <!-- Produk Info -->
            <div class="mb-6 text-center">
                <h3 class="text-2xl text-white font-bold text-gray-800 mb-2">{{ $produk->nama }}</h3>
                <p class="text-pink-600 font-extrabold text-lg">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                <img src="{{ asset('storage/' . $produk->gambar) }}" 
                     alt="{{ $produk->nama }}" 
                     class="w-full h-56 object-contain rounded-lg mt-3">

            </div>

            <!-- Form -->
            <form action="{{ route('User.store') }}" method="POST" class="space-y-5">
                @csrf

                <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                <!-- Nama Penjual -->
                <div>
                    <label class="block text-white font-semibold text-gray-700 mb-1">Nama Pembeli</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat Penjual -->
                <div>
                    <label class="block text-white font-semibold text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" rows="3"
                              class="w-full  border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jumlah Barang -->
                <div>
                    <label class="block  text-white font-semibold text-gray-700 mb-1">Jumlah Barang</label>
                    <input type="number" name="jumlah" min="1" value="1"
                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('jumlah')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Metode Pembayaran -->
                <div>
    <label class="block text-white font-semibold text-gray-700 mb-1">Metode Pembayaran</label>

    <div class="space-y-2">
        <label class="flex text-white items-center space-x-2">
            <input type="radio" name="metode_pembayaran" value="COD"
                   {{ old('metode_pembayaran') == 'COD' ? 'checked' : '' }}
                   class="text-indigo-600 focus:ring-indigo-500 border-gray-300">
            <span>COD (Bayar di Tempat)</span>
        </label>

        <label class="flex text-white items-center space-x-2">
            <input type="radio" name="metode_pembayaran" value="Transfer Bank"
                   {{ old('metode_pembayaran') == 'Transfer Bank' ? 'checked' : '' }}
                   class="text-indigo-600 focus:ring-indigo-500 border-gray-300">
            <span>Transfer Bank</span>
        </label>
    </div>

    @error('metode_pembayaran')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


                <!-- Tombol Submit -->
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg transition">
                        💰 Jual Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
