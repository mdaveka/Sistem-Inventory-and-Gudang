<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // 1. Menampilkan Halaman
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['message' => 'Supplier tidak ditemukan'], 404);
        }

        return response()->json($supplier);
    }

    // 2. Menyimpan Data Baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $supplier = Supplier::create($data);
        return response()->json($supplier, 201);
    }

    // 3. Update Data
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $supplier->update($data);
        return response()->json($supplier);
    }

    // 4. Hapus Data
    public function destroy($id)
    {
        Supplier::findOrFail($id)->delete();
        return response()->json(['message' => 'Supplier berhasil dihapus']);
    }
}
