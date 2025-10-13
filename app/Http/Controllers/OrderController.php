<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('User.index', compact('orders'));
    }

    
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

    public function create($produk_id)
    {
        $produk = Produk::findOrFail($produk_id);

        $metode_pembelian = ['COD', 'Transfer Bank'];
        $kurir = ['JNE', 'JNT', 'POS'];

        return view('User.create', compact('produk', 'metode_pembelian', 'kurir'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'metode' => 'required|string',
            'kurir' => 'required|string',
            'alamat' => 'required|string|max:255',
            'status' => 'nullable|string',
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        // Cek stok cukup
        if ($produk->stok < $request->jumlah) {
            return back()->with('error', 'Stok produk tidak cukup.');
        }

        $total = $produk->harga * $request->jumlah;

        // Buat pesanan
        Order::create([
            'user_id' => Auth::id(),
            'produk_id' => $produk->id,
            'jumlah' => $request->jumlah,
            'total_harga' => $total,
            'metode' => $request->metode,
            'kurir' => $request->kurir,
            'alamat' => $request->alamat,
            'status' => $request->status,
        ]);

        // Kurangi stok produk
        $produk->decrement('stok', $request->jumlah);

        return redirect()->route('User.index')->with('success', 'Pesanan berhasil dibuat!');
    }


    public function show($id)
    {
        // Ambil order beserta relasi agar efisien
        $order = Order::with(['produk', 'user'])->findOrFail($id);

        // Authorization lebih dulu agar tidak ada unreachable code
        $user = Auth::user();
        if ($user && $user->role !== 'Seller' && $order->user_id !== $user->id) {
            abort(403, 'Kamu tidak punya akses ke pesanan ini.');
        }

        // Kembalikan view dengan data yang diperlukan (halaman User)
        return view('User.show', [
            'orders' => $order,
            'produk' => $order->produk,
        ]);
    }
}