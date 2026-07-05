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
        $data = $request->validate([
            'barang_id' => 'required|integer|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $barang = Barang::find($data['barang_id']);

        if ($data['jumlah'] > $barang->stok) {
            return response()->json([
                'message' => 'Gagal! Stok tidak cukup.',
                'sisa_stok' => $barang->stok,
            ], 422);
        }

        $barangKeluar = BarangKeluar::create($data);

        // Kurangi stok di master barang
        $barang->stok -= $data['jumlah'];
        $barang->save();

        return response()->json([
            'message' => 'Barang berhasil dikeluarkan dan stok berkurang!',
            'data' => $barangKeluar,
            'barang' => $barang,
        ]);
    }
}