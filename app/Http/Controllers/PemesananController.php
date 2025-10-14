<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For sellers, show all orders
        $orders = Order::with('produk')->latest()->get();
        return view('Pemesanan.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ambil order beserta relasi agar efisien
        $order = Order::with(['produk', 'user'])->findOrFail($id);

        // Authorization lebih dulu agar tidak ada unreachable code
        $user = Auth::user();
        if ($user && $user->role !== 'Seller' && $order->user_id !== $user->id) {
            abort(403, 'Kamu tidak punya akses ke pesanan ini.');
        }

        // Kembalikan view dengan data yang diperlukan
        return view('Pemesanan.show', [
            'order' => $order,
        ]);
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
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Processed,Canceled,Confirmed,Sending'
        ]);

        $order = Order::findOrFail($id);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
