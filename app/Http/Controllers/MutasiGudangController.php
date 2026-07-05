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
        return response()->json($mutasis);
    }

    public function create()
    {
        $barangs = Barang::all();
        $gudangs = Gudang::all();
        return response()->json([
            'barangs' => $barangs,
            'gudangs' => $gudangs,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'barang_id' => 'required|integer|exists:barangs,id',
            'gudang_asal_id' => 'required|integer|exists:gudangs,id',
            'gudang_tujuan_id' => 'required|integer|exists:gudangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_mutasi' => 'nullable|date',
        ]);

        $mutasi = MutasiGudang::create($data);
        return response()->json($mutasi, 201);
    }

    public function show(MutasiGudang $mutasi)
    {
        return response()->json($mutasi);
    }

    public function edit($id)
    {
        $mutasi = MutasiGudang::findOrFail($id);
        $barangs = Barang::all();
        $gudangs = Gudang::all();
        return response()->json([
            'mutasi' => $mutasi,
            'barangs' => $barangs,
            'gudangs' => $gudangs,
        ]);
    }

    public function update(Request $request, $id)
    {
        $mutasi = MutasiGudang::findOrFail($id);
        $data = $request->validate([
            'barang_id' => 'sometimes|required|integer|exists:barangs,id',
            'gudang_asal_id' => 'sometimes|required|integer|exists:gudangs,id',
            'gudang_tujuan_id' => 'sometimes|required|integer|exists:gudangs,id',
            'jumlah' => 'sometimes|required|integer|min:1',
            'tanggal_mutasi' => 'nullable|date',
        ]);

        $mutasi->update($data);
        return response()->json($mutasi);
    }

    public function destroy($id)
    {
        $mutasi = MutasiGudang::findOrFail($id);
        $mutasi->delete();
        return response()->json(['message' => 'Mutasi berhasil dihapus']);
    }
}