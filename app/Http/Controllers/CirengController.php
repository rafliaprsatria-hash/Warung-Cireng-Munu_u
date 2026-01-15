<?php

namespace App\Http\Controllers;

use App\Models\Cireng;
use App\Models\Pembeli;
use Illuminate\Http\Request;

class CirengController extends Controller
{
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
        'nama_menu' => 'required',
        'harga' => 'required|numeric',
        'stok' => 'required|numeric',
    ]);

    // Mengambil data dari form dan simpan ke database
    \App\Models\Cireng::create($request->all());

    return redirect()->route('cireng.index')->with('success', 'Menu Cireng Berhasil Ditambah!');
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|string|max:255',
        ]);

        $cireng = Cireng::findOrFail($id);
        $cireng->update($request->all());

        return redirect()->back()->with('success', 'Menu Cireng berhasil diupdate!');
    }

    public function destroy($id)
    {
        $cireng = Cireng::findOrFail($id);
        $cireng->delete();

        return redirect()->back()->with('success', 'Menu Cireng berhasil dihapus!');
    }
}
