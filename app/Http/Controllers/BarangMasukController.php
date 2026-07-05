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
        $data = $request->validate([
            'barang_id' => 'required|integer|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'supplier_id' => 'nullable|integer|exists:suppliers,id',
            'gudang_id' => 'nullable|integer|exists:gudangs,id',
        ]);

        $barangMasuk = BarangMasuk::create($data);

        $barang = Barang::find($data['barang_id']);
        $barang->stok += $data['jumlah'];
        $barang->save();

        return response()->json([
            'message' => 'Barang berhasil masuk dan stok bertambah otomatis!',
            'data' => $barangMasuk,
            'barang' => $barang,
        ], 201);
    }
    
   
}