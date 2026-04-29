<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        //riwayat barang keluar
        $barang_keluars = BarangKeluar::all();
        return view('barang_keluar.index', compact('barang_keluars'));
    }

    public function create()
    {
        // Ambil data barang buat dropdown di form
        $barangs = Barang::all();
        return view('barang_keluar.create', compact('barangs'));
    }

    public function store(Request $request)
    {
       
        $barang = Barang::find($request->barang_id);

        
        if ($request->jumlah > $barang->stok) {
           
            return redirect()->back()->with('error', 'Gagal! Stok tidak cukup. Sisa stok saat ini: ' . $barang->stok);
        }

     
        BarangKeluar::create($request->all());

        //Kurangi stok di master barang
        $barang->stok -= $request->jumlah;
        $barang->save();

        return redirect('/barang')->with('success', 'Barang berhasil dikeluarkan dan stok berkurang!');
    }
}