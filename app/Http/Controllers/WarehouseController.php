<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('warehouse.index', compact('warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string',
        ]);

        Warehouse::create($request->all());
        return redirect()->route('warehouse.index')->with('success', 'Gudang berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->update($request->all());
        return redirect()->route('warehouse.index')->with('success', 'Data Gudang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Warehouse::findOrFail($id)->delete();
        return redirect()->route('warehouse.index')->with('success', 'Gudang berhasil dihapus!');
    }
}
