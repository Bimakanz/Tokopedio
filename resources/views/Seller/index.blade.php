<x-app-layout>
    <x-slot name="header">        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Selamat datang, ') . Auth::user()->name . ' !' }}
        </h2>
    </x-slot>
    
    <div class="p-8">
        <div class="p-10 rounded-2xl shadow-xl mt-5 border border-gray-700 bg-gradient-to-br from-gray-800 to-gray-900">
            <div class="flex flex-row justify-between">
                <div class="text-white">
                    <h1 class="font-bold text-3xl text-white bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500">
                        Kelola Produk</h1>
                    <p class="text-center text-2xl text-gray-300 mt-2">
                        Kelola produk Anda dengan mudah di sini.</p>
                </div>
                <a href="Seller/produk/create"
                    class="p-4 rounded-xl inline-flex justify-center items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-center text-xl hover:from-indigo-700 hover:to-purple-700 transition">
                    Tambah Produk
                </a>
            </div>
        </div>

        <!-- TABLE PRODUK -->
        <section class=" mt-10">
            <div class=" max-w-screen-full mx-2">
                <!-- Start coding here -->
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 relative shadow-xl sm:rounded-2xl overflow-hidden border border-gray-700">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    </div>
                    <h1
                class="text-center text-3xl font-extrabold mb-8 text-white bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-500">
                Daftar Produk
            </h1>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-400">
                            <thead class="text-xs text-gray-300 uppercase bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3">NO</th>
                                    <th scope="col" class="px-6 py-3">GAMBAR</th>
                                    <th scope="col" class="px-6 py-3">NAMA</th>
                                    <th scope="col" class="px-6 py-3">STOCK</th>
                                    <th scope="col" class="px-6 py-3">HARGA</th>
                                    <th scope="col" class="px-6 py-3">STATUS</th>
                                    <th scope="col" class="px-6 py-3">DETAILS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @if ($produk->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center py-10">
                                            <span class="text-3xl font-extrabold text-gray-500">BELUM ADA PRODUK</span>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($produk as $p)
                                        <tr class="border-b border-gray-700 hover:bg-gray-750 transition">
                                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4">
                                                @if($p['gambar'])
                                                    <img src="{{ asset('storage/' . $p['gambar']) }}" alt=""
                                                        class="w-20 h-20 object-cover rounded-xl mb-3 border border-gray-600">
                                                @else
                                                    <div class="w-20 h-20 flex items-center justify-center bg-gray-700 text-gray-400 rounded-xl">
                                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 font-medium text-gray-200 whitespace-nowrap">
                                                {{ $p['nama'] }}
                                            </td>
                                            <td class="px-6 py-4 text-gray-300">{{ $p['stok'] }}</td>
                                            <td class="px-6 py-4 text-green-400 font-semibold">
                                                Rp. {{ number_format($p->harga, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="{{ $p['status'] === 'Aktif' ? 'text-green-400' : 'text-red-400' }} uppercase font-semibold">
                                                    {{ $p['status'] }}
                                                </span>
                                            </td>

                                            <td class="px-6 py-4">
                                                <a href="{{ route('produk.show', $p->id) }}"
                                                    class="inline-flex justify-center items-center px-4 py-2 rounded-lg text-white text-center bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 transition">
                                                    Details
                                                </a>
                                            </td>

                                            <td class="relative px-6 py-4 text-right">
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
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>