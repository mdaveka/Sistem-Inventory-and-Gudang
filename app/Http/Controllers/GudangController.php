<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        $gudangs = Gudang::all();
        return response()->json($gudangs);
    }

    public function create()
    {
        return response()->json(['message' => 'Not applicable for API'], 204);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_gudang' => 'required|string|max:255',
            'lokasi' => 'nullable|string',
            'kapasitas' => 'nullable|integer',
        ]);

        $gudang = Gudang::create($data);
        return response()->json($gudang, 201);
    }

    public function show(Gudang $gudang)
    {
        return response()->json($gudang);
    }

    public function edit(Gudang $gudang)
    {
        return response()->json($gudang);
    }

    public function update(Request $request, Gudang $gudang)
    {
        $data = $request->validate([
            'nama_gudang' => 'sometimes|required|string|max:255',
            'lokasi' => 'nullable|string',
            'kapasitas' => 'nullable|integer',
        ]);

        $gudang->update($data);
        return response()->json($gudang);
    }

    public function destroy(Gudang $gudang)
    {
        $gudang->delete();
        return response()->json(['message' => 'Gudang berhasil dihapus']);
    }
}