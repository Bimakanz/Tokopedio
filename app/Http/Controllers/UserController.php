<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
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
        $validated = $request->validate([
        'nama'   => 'required|string|max:255',
        'Tanggal_pinjam'  => 'required|date',
        'Tanggal_balikin' => 'required|date|after_or_equal:Tanggal_pinjam',
        'jumlah' => 'required|integer|min:1',
        'Nama_peminjam' => 'required|string|max:255',
    ]);
    $produk = Produk::where('nama', $request->nama)->first();
    $produk->decrement('jumlah', $request->jumlah);

    Form::create($validated);

    return redirect()->route('form.index')
                     ->with('success', 'Produk berhasil dipinjam!');
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
