<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Gudang;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{


    public function create()
    {
        
        $barangs = Barang::all();
        $suppliers = Supplier::all();
        $gudangs = Gudang::all();
        return view('barang_masuk.create', compact('barangs', 'suppliers', 'gudangs'));
    }

    public function store(Request $request)
    {
        // Simpan data transaksi barang masuk
        BarangMasuk::create($request->all());

        $barang = Barang::find($request->barang_id);
        $barang->stok += $request->jumlah; 
        $barang->save();

        return redirect('/barang')->with('success', 'Barang berhasil masuk dan stok bertambah otomatis!');
    }
    
   
}