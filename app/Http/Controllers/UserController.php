<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        return view('dashboard', compact('produk'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $produk = Produk::findOrFail($id); // ambil produk berdasarkan id
        return view('user.create', compact('produk'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validasi input
        $data = $request->validate([
            'produk_id'     => 'required|exists:produks,id',
            'nama_pemesan'  => 'required|string',
            'alamat'        => 'required|string',
            'jumlah'        => 'required|integer|min:1',
            'kurir'         => 'required|in:JNE,JNT,POS',
            'metode'        => 'required|in:COD,TRANSFER',
        ]);

        // ✅ Ambil produk berdasarkan ID
        $produk = Produk::findOrFail($data['produk_id']);

        // ✅ Hitung total harga
        $harga = (int)$produk->harga;
        $jumlah = (int)$data['jumlah'];
        $total_harga = $harga * $jumlah;

        // ✅ Jalankan transaksi database
        DB::transaction(function () use ($request, $produk, $jumlah, $total_harga) {
            // Simpan data pembelian (pastikan model User di sini adalah model transaksi pembelian, bukan akun user)
            User::create([
                'user_id'      => auth()->id(),
                'produk_id'    => $produk->id,
                'nama_pemesan' => $request->nama_pemesan,
                'alamat'       => $request->alamat,
                'jumlah'       => $request->jumlah,
                'kurir'        => $request->kurir,
                'metode'       => $request->metode,
                'total_harga'  => $total_harga,
            ]);

            // Kurangi stok produk
            $produk->update([
                'stok'   => $produk->stok - $jumlah,
                'status' => $produk->stok - $jumlah <= 0 ? 'Non-aktif' : 'Aktif',
            ]);
        });

        // ✅ Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Order berhasil dibuat!');
    }
            

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
