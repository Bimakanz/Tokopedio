<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 flex items-center justify-center">
        <div class="w-full max-w-3xl p-6 rounded-2xl shadow-2xl bg-gray-800 border border-gray-700">
            <h1 class="font-extrabold text-3xl text-white mb-6 text-center tracking-wide">
                Edit Produk
            </h1>

            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label class="block mb-1 text-gray-300 font-semibold" for="nama">Nama Barang</label>
                        <input type="text" name="nama" id="nama"
                               value="{{ old('nama', $produk->nama) }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-900 text-white focus:ring-2 focus:ring-purple-600 focus:outline-none"/>
                    </div>

                    <!-- Harga -->
                    <div>
                        <label class="block mb-1 text-gray-300 font-semibold" for="harga">Harga Barang</label>
                        <input type="text" name="harga" id="harga"
                               value="{{ old('harga', $produk->harga) }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-900 text-white focus:ring-2 focus:ring-purple-600 focus:outline-none"/>
                    </div>

                    <!-- Stok -->
                    <div>
                        <label class="block mb-1 text-gray-300 font-semibold" for="stok">Stock Barang</label>
                        <input type="number" name="stok" id="stok"
                               value="{{ old('stok', $produk->stok) }}"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-900 text-white focus:ring-2 focus:ring-purple-600 focus:outline-none"/>
                    </div>

                    <!-- Gambar -->
                    <div>
                        <label class="block mb-1 text-gray-300 font-semibold" for="gambar">Gambar Barang</label>
                        <input type="file" name="gambar" id="gambar"
                               class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-900 text-gray-300 focus:ring-2 focus:ring-purple-600 focus:outline-none"/>

                        @if($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Preview"
                                 class="w-24 h-24 object-cover rounded-lg mt-2 border border-gray-700">
                        @endif
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block mb-1 text-gray-300 font-semibold">Status Barang</label>
                        <div class="flex items-center space-x-6 mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="Aktif"
                                       {{ old('status', $produk->status) == 'Aktif' ? 'checked' : '' }}
                                       class="form-radio text-purple-600 focus:ring-purple-600">
                                <span class="ml-2 text-gray-200">Aktif</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="status" value="Non-aktif"
                                       {{ old('status', $produk->status) == 'Non-aktif' ? 'checked' : '' }}
                                       class="form-radio text-purple-600 focus:ring-purple-600">
                                <span class="ml-2 text-gray-200">Non-aktif</span>
                            </label>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="col-span-2">
                        <label class="block mb-1 text-gray-300 font-semibold" for="deskripsi">Deskripsi Barang</label>
                        <textarea name="deskripsi" id="deskripsi" rows="2"
                                  class="w-full px-4 py-2 rounded-lg border border-gray-600 bg-gray-900 text-white focus:ring-2 focus:ring-purple-600 focus:outline-none">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    </div>
                </div>

                <button type="submit"
                        class="w-full mt-6 py-3 rounded-lg bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold text-lg shadow-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-200">
                    Update Produk
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
