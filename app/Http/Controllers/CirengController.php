<?php

namespace App\Http\Controllers;

use App\Models\Cireng;
use App\Models\Pembeli;
use Illuminate\Http\Request;

class CirengController extends Controller
{
    public function dashboard()
    {
        $cirengs = Cireng::all();
        $orders = \App\Models\Order::orderBy('created_at', 'desc')->limit(5)->get();
        
        // Hitung statistik
        $totalMenu = $cirengs->count();
        $totalRevenue = $cirengs->sum('harga');
        $averagePrice = $totalMenu > 0 ? $totalRevenue / $totalMenu : 0;
        $totalStok = $cirengs->sum('stok');
        $totalOrders = \App\Models\Order::count();
        $totalProdukTerjual = \App\Models\Order::sum('quantity'); // Total quantity dari semua pesanan
        
        // Data untuk kategori chart
        $categoryData = [
            'labels' => $cirengs->groupBy('kategori')->keys()->toArray(),
            'data' => $cirengs->groupBy('kategori')->map(function($items) {
                return $items->count();
            })->values()->toArray()
        ];
        
        return view('dashboard', compact('cirengs', 'orders', 'totalMenu', 'totalRevenue', 'averagePrice', 'totalStok', 'totalOrders', 'totalProdukTerjual', 'categoryData'));
    }

    public function index()
    {
        $cirengs = \App\Models\Cireng::all();
        $pembelis = \App\Models\Pembeli::all(); 

        // Pastikan nama 'index' di bawah ini sesuai dengan nama file index.blade.php
        return view('index', compact('cirengs', 'pembelis'));
    }

    public function menu()
    {
        $cirengs = Cireng::all();
        return view('menu', compact('cirengs'));
    }
   public function store(Request $request)
{
    $request->validate([
        'nama_menu' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'link_wa' => 'required|url',
        'link_img' => 'required|url',
        'deskripsi' => 'required|string',
    ]);

    $data = $request->all();
    $data['stok'] = $request->input('stok', 0); // Default stok = 0
    $data['kategori'] = $request->input('kategori', 'Snack'); // Default kategori
    
    \App\Models\Cireng::create($data);

    return redirect()->route('cireng.index')->with('success', 'Menu Cireng Berhasil Ditambah!');
}

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'link_wa' => 'required|url',
            'link_img' => 'required|url',
            'deskripsi' => 'required|string',
        ]);

        $cireng = Cireng::findOrFail($id);
        $cireng->update($validated);

        return redirect()->back()->with('success', 'Menu Cireng berhasil diupdate!');
    }

    public function destroy($id)
    {
        $cireng = Cireng::findOrFail($id);
        $cireng->delete();

        return redirect()->back()->with('success', 'Menu Cireng berhasil dihapus!');
    }
}
