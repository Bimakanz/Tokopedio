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
            'status' => 'required|in:Pending,Processed,Confirmed,Sending,Canceled'
        ]);

        $order = Order::with('produk')->findOrFail($id);
        $user = Auth::user();

        if (!$user || $user->role !== 'Seller') {
            abort(403, 'Hanya penjual yang bisa mengubah status pesanan.');
        }

        $prevStatus = $order->status;
        $newStatus = $request->status;
        $produk = $order->produk;
        $jumlah = $order->jumlah;

        $reduceStatuses = ['Processed', 'Confirmed', 'Sending'];

        // Kalau status berubah ke "Canceled", stok dikembalikan sebanyak jumlah yang dibeli
        if ($newStatus === 'Canceled') {
            // Cuma balikin stok kalau stok sebelumnya memang sudah dikurangi
            if (in_array($prevStatus, $reduceStatuses)) {
                $produk->increment('stok', $jumlah);
            }
        }
        // Kalau dari Canceled ke status pengurang stok → kurangi stok lagi
        elseif ($prevStatus === 'Canceled' && in_array($newStatus, $reduceStatuses)) {
            if ($produk->stok < $jumlah) {
                return back()->with('error', 'Stok produk tidak mencukupi.');
            }
            $produk->decrement('stok', $jumlah);
        }

        // Kalau dari status pengurang stok ke Pending → balikin stok
        elseif (in_array($prevStatus, $reduceStatuses) && $newStatus === 'Pending') {
            $produk->increment('stok', $jumlah);
        }

        $order->update(['status' => $newStatus]);

        $messages = [
            'Pending' => 'Status diubah ke Pending.',
            'Processed' => 'Pesanan diproses dan stok dikurangi.',
            'Sending' => 'Pesanan sedang dikirim.',
            'Confirmed' => 'Pesanan dikonfirmasi selesai.',
            'Canceled' => 'Pesanan dibatalkan dan stok dikembalikan.'
        ];

        return back()->with('success', $messages[$newStatus] ?? 'Status diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
