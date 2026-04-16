<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        $gudangs = Gudang::all();
        return view('gudang.index', compact('gudangs'));
    }

    public function create()
    {
        return view('gudang.create');
    }

    public function store(Request $request)
    {
        Gudang::create([
            'nama_gudang' => $request->nama_gudang,
            'lokasi'      => $request->lokasi,
            'kapasitas'   => $request->kapasitas,
        ]);

        return redirect()->route('gudang.index');
    }

    public function show(Gudang $gudang)
    {
        // Kosongin dulu
    }

    public function edit(Gudang $gudang)
    {
        return view('gudang.edit', compact('gudang'));
    }

    public function update(Request $request, Gudang $gudang)
    {
        $gudang->update([
            'nama_gudang' => $request->nama_gudang,
            'lokasi'      => $request->lokasi,
            'kapasitas'   => $request->kapasitas,
        ]);

        return redirect()->route('gudang.index');
    }

    public function destroy(Gudang $gudang)
    {
        $gudang->delete();

        return redirect()->route('gudang.index');
    }
}