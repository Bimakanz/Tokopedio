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

        $order = Order::with('produk')->findOrFail($id);
        $previousStatus = $order->status;

        // Status yang memerlukan pengurangan stok: Processed, Sending, Confirmed
        $stockReducingStatuses = ['Processed', 'Sending', 'Confirmed'];
        
        // Jika status sebelumnya adalah Pending dan sekarang berubah ke status yang perlu pengurangan stok
        if ($previousStatus === 'Pending' && in_array($request->status, $stockReducingStatuses)) {
            // Kurangi stok produk
            $order->produk->stok -= $order->jumlah;
            $order->produk->save();
        }
        // Jika status sebelumnya termasuk yang memerlukan pengurangan stok dan sekarang menjadi Pending
        elseif (in_array($previousStatus, $stockReducingStatuses) && $request->status === 'Pending') {
            // Kembalikan stok produk
            $order->produk->stok += $order->jumlah;
            $order->produk->save();
        }
        // Jika status sebelumnya termasuk yang memerlukan pengurangan stok dan sekarang menjadi Canceled
        elseif (in_array($previousStatus, $stockReducingStatuses) && $request->status === 'Canceled') {
            // Kembalikan stok produk
            $order->produk->stok += $order->jumlah;
            $order->produk->save();
        }
        // Jika status sebelumnya adalah Canceled dan sekarang berubah ke status yang perlu pengurangan stok
        elseif ($previousStatus === 'Canceled' && in_array($request->status, $stockReducingStatuses)) {
            // Kurangi stok produk
            $order->produk->stok -= $order->jumlah;
            $order->produk->save();
        }
        // Jika status sebelumnya adalah Pending dan sekarang menjadi Canceled (tidak ada perubahan stok karena tidak dikurangi dari awal)
        elseif ($previousStatus === 'Pending' && $request->status === 'Canceled') {
            // Tidak perlu mengurangi stok karena sebelumnya juga tidak dikurangi
        }
        // Jika status sebelumnya adalah Canceled dan sekarang kembali ke Pending (tidak ada perubahan stok)
        elseif ($previousStatus === 'Canceled' && $request->status === 'Pending') {
            // Tidak ada perubahan stok
        }

        $order->status = $request->status;
        $order->save();

        // Pesan notifikasi berdasarkan status
        $statusMessages = [
            'Pending' => 'Status pesanan diubah menjadi Pending.',
            'Processed' => 'Status pesanan diubah menjadi Processed. Stok produk telah dikurangi.',
            'Sending' => 'Status pesanan diubah menjadi Sending. Produk sedang dikirim.',
            'Confirmed' => 'Status pesanan diubah menjadi Confirmed. Pesanan selesai.',
            'Canceled' => 'Status pesanan diubah menjadi Canceled. Stok produk telah dikembalikan.'
        ];

        $message = $statusMessages[$request->status] ?? 'Status berhasil diperbarui!';
        return redirect()->back()->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
