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
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'link_wa' => 'required|url',
            'link_img' => 'required|url',
            'deskripsi' => 'required|string',
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
