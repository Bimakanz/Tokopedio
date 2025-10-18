<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Daftar produk mu, ') . Auth::user()->name . ' !' }}
        </h2>
    </x-slot>
    <div class="p-8">
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
        
        <div class="p-10 rounded-2xl shadow-xl  border border-gray-700 bg-gradient-to-br from-gray-800 to-gray-900">
            <div class="flex flex-row justify-between">
                <div class="text-white">
                    <h1 class="font-bold text-3xl text-white bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500">
                        Kelola Produk</h1>
                    <p class="text-center text-2xl text-gray-300 mt-2">
                        Kelola produk Anda dengan mudah di sini.</p>
                </div>
                <a href="Seller/produk/create"
                    class="p-4 rounded-xl inline-flex uppercase font-bold justify-center items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-center text-xl hover:from-indigo-700 hover:to-purple-700 transition">
                    Tambah Produk
                </a>
            </div>
        </div>

    </div>
    <section class="">
    <div class="max-w-screen-full mx-12">
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 shadow-xl rounded-2xl p-8 border border-gray-700">
            <h1
                class="text-center text-3xl font-extrabold mb-8 text-white bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500">
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
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
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
                                        <div x-data="{ open: false }" class="inline-block text-left">
                                            <!-- Tombol utama (⋮) -->
                                            <button @click="open = !open"
                                                class="p-2 rounded-full bg-gray-700 hover:bg-gray-600 text-gray-300 focus:outline-none transition">
                                                <!-- Icon titik tiga -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <circle cx="12" cy="6" r="1.8" />
                                                    <circle cx="12" cy="12" r="1.8" />
                                                    <circle cx="12" cy="18" r="1.8" />
                                                </svg>
                                            </button>

                                            <!-- Dropdown menu -->
                                            <div x-show="open" @click.away="open = false"
                                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-gray-800 ring-1 ring-gray-700 z-50">
                                                <div class="py-1">
                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('produk.edit', $p->id) }}"
                                                        class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition">
                                                        ✏️ Edit
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <form action="{{ route('produk.destroy', $p->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Yakin hapus?')"
                                                            class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition">
                                                            🗑️ Hapus
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
</x-app-layout>