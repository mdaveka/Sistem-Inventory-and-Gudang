<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        // Menampilkan semua data
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        // Menampilkan form tambah data
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        // Menyimpan data baru ke database
        Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'no_telepon'    => $request->no_telepon,
            'alamat'        => $request->alamat,
        ]);

        return redirect()->route('supplier.index');
    }

    public function show(Supplier $supplier)
    {
        // Ini biarin kosong dulu (biasanya buat halaman detail)
    }

    public function edit(Supplier $supplier)
    {
        // Menampilkan form edit dengan data lama
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        // Menyimpan perubahan data ke database
        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'no_telepon'    => $request->no_telepon,
            'alamat'        => $request->alamat,
        ]);

        return redirect()->route('supplier.index');
    }

    public function destroy(Supplier $supplier)
    {
        // Menghapus data dari database
        $supplier->delete();

        return redirect()->route('supplier.index');
    }
}