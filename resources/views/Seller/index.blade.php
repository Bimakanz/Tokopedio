<x-app-layout>
    <div class="p-8">
        <h1
            class=" p-4 rounded-lg text-5xl font-extrabold text-center bg-gradient-to-r from-indigo-100 via-purple-900 to-pink-100 text-transparent bg-clip-text drop-shadow-2xl animate-pulse  ">
            Selamat Datang, {{ Auth::user()->name }} !
        </h1>

        <div class="p-4 rounded-lg mt-5">
            <div class="flex flex-row justify-between">
                <div class="text-white">
                    <h1
                        class="font-bold text-3xl bg-gradient-to-r from-indigo-100 via-purple-900 to-pink-100 text-transparent bg-clip-text drop-shadow-2xl animate-pulse">
                        Kelola Produk</h1>
                    <p
                        class="text-center text-2xl bg-gradient-to-r from-indigo-500 via-purple-900 to-pink-500 text-transparent bg-clip-text drop-shadow-2xl animate-pulse">
                        Kelola produk Anda dengan mudah di sini.</p>
                </div>
                <a href="Seller/produk/create"
                    class="p-4 rounded-lg text-xl bg-slate-800 text-center bg-gradient-to-r from-indigo-100 via-purple-900 to-pink-100 drop-shadow-2xl animate-pulse ">Tambah
                    Produk</a>
            </div>
        </div>

        <!-- TABLE PRODUK -->
        <section class="bg-gray-50 dark:bg-gray-900 p-3 mt-10 sm:p-5">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-10 py-3">NO</th>
                                    <th scope="col" class="px-7 py-3">GAMBAR</th>
                                    <th scope="col" class="px-5 py-3">NAMA</th>
                                    <th scope="col" class="px-3 py-3">STOCK</th>
                                    <th scope="col" class="px-10 py-3">HARGA</th>
                                    <th scope="col" class="px-8 py-3">STATUS</th>
                                    <th scope="col" class="px-10 py-3">DETAILS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($produk->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center py-10">
                                            <span class="text-3xl font-extrabold text-gray-400">BELUM ADA PRODUK</span>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($produk as $p)
                                                    <tr class="border-b dark:border-gray-700">
                                                        <td class="px-5 py-3">{{ $loop->iteration }}</td>
                                                        <td class="px-4 py-3">
                                                            @if($p['gambar'])
                                                                <img src="{{ asset('storage/' . $p['gambar']) }}" alt=""
                                                                    class="w-20 h-20 object-cover rounded-xl mb-3">
                                                            @endif
                                                        </td>
                                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ $p['nama'] }}
                                                        </td>
                                                        <td class="px-7 py-3">{{ $p['stok'] }}</td>
                                                        <td class="px-4 py-3 text-green-400 font-semibold">
                                                            Rp. {{ number_format($p->harga, 2, ',', '.') }}
                                                        </td>
                                                        <th class="px-7 py-3">
                                                            <span
                                                                class="{{ $p['status'] === 'Aktif' ? 'text-green-500' : 'text-red-500' }} font-semibold">
                                                                {{ $p['status'] }}
                                                            </span>
                                                        </th>

                                                        <th class="px-7 py-3">
                                                        <a href="{{ route('produk.show', $p->id) }}"
                                                            class="inline-flex justify-center items-center px-4 py-2 text-center bg-gradient-to-r from-indigo-100 via-purple-900 to-pink-100 drop-shadow-2xl animate-pulse text-white text-sm font-semibold rounded-lg shadow-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                                        Details
                                                        </a>
                                                        </th>

                                                        <td class="relative px-4 py-3 text-right">
    <div x-data="{ open: false }" class="inline-block text-left">
        <!-- Tombol utama (⋮) -->
        <button @click="open = !open"
            class="p-2 rounded-full hover:bg-gray-700 focus:outline-none transition">
            <!-- Icon titik tiga lebih tebal -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-7 w-7 text-white font-bold" 
                 viewBox="0 0 24 24" fill="currentColor">
                <circle cx="12" cy="6" r="1.8" />
                <circle cx="12" cy="12" r="1.8" />
                <circle cx="12" cy="18" r="1.8" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div x-show="open" @click.away="open = false"
            class="origin-top-right absolute right-0 mt-2 w-36 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 z-50">
            <div class="py-1">
                <!-- Tombol Edit -->
                <a href="{{ route('produk.edit', $p->id) }}"
                    class="block px-4 py-2 text-sm text-gray-200 hover:bg-yellow-600 hover:text-white">
                    ✏️ Edit
                </a>

                <!-- Tombol Hapus -->
                <form action="{{ route('produk.destroy', $p->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus?')"
                        class="w-full text-left px-4 py-2 text-sm text-gray-200 hover:bg-red-600 hover:text-white">
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