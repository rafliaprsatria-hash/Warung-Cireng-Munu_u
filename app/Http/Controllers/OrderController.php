<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cireng;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        $cirengs = Cireng::all();
        
        return view('orders', compact('orders', 'cirengs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'cireng_id' => 'required|exists:cirengs,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cireng = Cireng::findOrFail($request->cireng_id);
        
        $order = new Order();
        $order->nama_pelanggan = $request->nama_pelanggan;
        $order->cireng_id = $request->cireng_id;
        $order->nama_produk = $cireng->nama_menu;
        $order->quantity = $request->quantity;
        $order->total_harga = $cireng->harga * $request->quantity;
        $order->status = 'Pending';
        $order->nomor_wa = $request->nomor_wa ?? $cireng->link_wa;
        $order->save();

        // Return JSON response if it's a fetch request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil ditambahkan!',
                'nama_produk' => $order->nama_produk,
                'total_harga_format' => number_format($order->total_harga, 0, ',', '.')
            ]);
        }

        return redirect()->back()->with('success', 'Pesanan berhasil ditambahkan!');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus!');
    }
}

