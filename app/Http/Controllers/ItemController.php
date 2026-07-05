<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        // Fitur Search & Pagination (10 data per halaman)
        $search = $request->input('search');
        
        $items = Item::with('supplier')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('barcode', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);
            
        $suppliers = Supplier::all();
        return view('items.index', compact('items', 'suppliers', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barcode' => 'nullable|string|max:50|unique:items,barcode',
            'name' => 'required',
            'supplier_id' => 'required',
            'stock' => 'required|integer|min:0|max:1500',
            'min_stock' => 'nullable|integer|min:0|max:1500',
        ],[
            'barcode.unique' => 'Kode barcode sudah terdaftar! Gunakan kode lain atau biarkan kosong.',
        ]);

        // Generate Barcode otomatis jika kosong
        $barcode = $request->barcode ?? 'BRC-' . strtoupper(uniqid());

        Item::create([
            'barcode' => $barcode,
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'stock' => $request->stock,
            'min_stock' => $request->min_stock ?? 10,
        ]);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'barcode' => 'required|string|max:50|unique:items,barcode,' . $item->id,
            'name' => 'required',
            'supplier_id' => 'required',
            'stock' => 'required|integer|min:0|max:1500',
            'min_stock' => 'nullable|integer|min:0|max:1500',
        ],[
            'barcode.unique' => 'Kode barcode sudah digunakan oleh barang lain!',
        ]);

        // Menggunakan data yang sudah tervalidasi agar aman dari manipulasi angka besar
        $item->update($validatedData);

        return redirect()->route('items.index')->with('success', 'Data barang berhasil diupdate!');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus!');
    }

    // FITUR BARU: Cetak Barcode Massal
    public function printBarcode(Request $request)
    {
        // Validasi minimal 1 barang harus dipilih
        $request->validate([
            'item_ids' => 'required|array|min:1',
        ], [
            'item_ids.required' => 'Pilih minimal satu barang untuk dicetak barcodenya!'
        ]);

        // Ambil data barang yang dicentang
        $items = Item::with('supplier')->whereIn('id', $request->item_ids)->get();
        
        return view('items.print_barcode', compact('items'));
    }
}