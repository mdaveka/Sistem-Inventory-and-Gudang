<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    // menampilkan semua barang
    public function index()
    {
       return response()->json(Barang::with(['supplier','gudang'])->get());
    }

    // menampilkan 1 barang
    public function show($id)
    {
        $barang = Barang::with(['supplier','gudang'])->find($id);

        if(!$barang){
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }

        return response()->json($barang);
    }

    // menambah barang
    public function store(Request $request)
    {
        $barang = Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'supplier_id' => $request->supplier_id,
            'gudang_id' => $request->gudang_id
        ]);

        return response()->json($barang, 201);
    }

    // update barang
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if(!$barang){
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }

        $barang->update($request->all());

        return response()->json($barang);
    }

    // hapus barang
    public function destroy($id)
    {
        $barang = Barang::find($id);

        if(!$barang){
            return response()->json(['message' => 'Barang tidak ditemukan'], 404);
        }

        $barang->delete();

        return response()->json(['message' => 'Barang berhasil dihapus']);
    }
}