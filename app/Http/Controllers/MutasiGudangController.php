<?php

namespace App\Http\Controllers;

use App\Models\MutasiGudang; 
use App\Models\Gudang;
use App\Models\Barang;
use Illuminate\Http\Request;

class MutasiGudangController extends Controller
{
    public function index()
    {
        // Mengambil semua data mutasi
        $mutasis = MutasiGudang::all();
        return view('mutasi.index', compact('mutasis'));
    }

    public function create()
    {
        
        $barangs = Barang::all();
        $gudangs = Gudang::all();
        return view('mutasi.create', compact('barangs', 'gudangs'));
    }

    public function store(Request $request)
    {
        MutasiGudang::create([
            'barang_id'        => $request->barang_id,
            'gudang_asal_id'   => $request->gudang_asal_id,
            'gudang_tujuan_id' => $request->gudang_tujuan_id,
            'jumlah'           => $request->jumlah,
            'tanggal_mutasi'   => $request->tanggal_mutasi,
        ]);

        return redirect()->route('mutasi.index');
    }

    public function show(MutasiGudang $mutasi)
    {
        //
    }

    public function edit($id)
    {
        $mutasi = MutasiGudang::findOrFail($id);
        $barangs = Barang::all();
        $gudangs = Gudang::all();
        return view('mutasi.edit', compact('mutasi', 'barangs', 'gudangs'));
    }

    public function update(Request $request, $id)
    {
        $mutasi = MutasiGudang::findOrFail($id);
        $mutasi->update([
            'barang_id'        => $request->barang_id,
            'gudang_asal_id'   => $request->gudang_asal_id,
            'gudang_tujuan_id' => $request->gudang_tujuan_id,
            'jumlah'           => $request->jumlah,
            'tanggal_mutasi'   => $request->tanggal_mutasi,
        ]);

        return redirect()->route('mutasi.index');
    }

    public function destroy($id)
    {
        $mutasi = MutasiGudang::findOrFail($id);
        $mutasi->delete();

        return redirect()->route('mutasi.index');
    }
}