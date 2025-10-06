<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::paginate(10);
        return view('Seller.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Seller.produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'status'    => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string|max:500',
            'harga' => 'required|integer|min:1',
            'stok' => 'required|integer|min:1',
        ]);

        $data = $request->only(['nama', 'status', 'deskripsi', 'harga', 'stok']);

        if ($request->hasFile('gambar')) {
            $fileName = time().'_'.$request->gambar->getClientOriginalName();
            // simpan ke storage/app/public/produk
            $path = $request->gambar->storeAs('produk', $fileName, 'public');
            $data['gambar'] = $path;
        }

        Produk::create($data);

        return redirect()->route('Seller.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $produk = Produk::findOrFail($id);
        return view('Seller.produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        return view('Seller.produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // 1. Validasi
    $validated = $request->validate([
        'nama'      => 'required|string|max:255',
        'harga'     => 'required|integer|min:1',
        'stok'      => 'required|integer|min:0',
        'status'    => 'required|in:Aktif,Non-aktif',
        'deskripsi' => 'nullable|string|max:500',
        'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // 2. Cari produk
    $produk = Produk::findOrFail($id);

    // 3. Handle upload gambar baru
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $fileName = time() . '_' . $request->gambar->getClientOriginalName();
        $path = $request->gambar->storeAs('produk', $fileName, 'public');

        // Simpan path di DB
        $validated['gambar'] = $path;
    } else {
        // Kalau tidak upload gambar baru, tetap pakai lama
        unset($validated['gambar']);
    }

    // 4. Update produk
    $produk->update($validated);

    // 5. Redirect balik dengan pesan sukses
    return redirect()->route('Seller.index')->with('success', 'Produk berhasil diperbarui!');
}
    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    // 1. Cari produk berdasarkan ID
    $produk = Produk::findOrFail($id);

    // 2. Hapus file gambar kalau ada
    if ($produk->gambar) {
        Storage::disk('public')->delete($produk->gambar);
    }

    // 3. Hapus data produk dari database
    $produk->delete();

    // 4. Redirect balik dengan pesan sukses
    return redirect()->route('Seller.index')->with('success', 'Produk berhasil dihapus!');
}
}
