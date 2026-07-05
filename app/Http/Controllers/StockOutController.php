<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockOut;
use App\Models\StockLog;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockOutController extends Controller
{
    public function index()
    {
        $stockOuts = StockOut::with(['item', 'warehouse'])->latest()->get();
        $items = Item::all();
        $warehouses = Warehouse::all();
        return view('stock_out.index', compact('stockOuts', 'items', 'warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'warehouse_id' => 'required',
            'qty' => 'required|integer|min:1|max:1500',
            'date_out' => 'required|date'
        ]);

        $item = Item::findOrFail($request->item_id);

        // VALIDASI KEAMANAN: Cek apakah stok cukup
        if ($request->qty > $item->stock) {
            return redirect()->back()->withErrors(['qty' => 'GAGAL: Stok tidak mencukupi! Sisa stok ' . $item->name . ' hanya ' . $item->stock . ' unit.'])->withInput();
        }

        // Kurangi stok
        $item->decrement('stock', $request->qty);

        // Catat di StockOut
        StockOut::create([
            'item_id' => $request->item_id,
            'warehouse_id' => $request->warehouse_id,
            'qty' => $request->qty,
            'date_out' => $request->date_out,
            'destination' => $request->destination,
            'user_id' => Auth::id(), // <-- INI YANG KURANG (Mencatat ID User yang sedang login)
        ]);

        // Catat di Log Buku Besar
        StockLog::create([
            'item_id' => $request->item_id,
            'user_id' => Auth::id(),
            'type' => 'OUT',
            'qty' => $request->qty,
            'description' => 'Dikeluarkan dari gudang ke ' . ($request->destination ?? 'Tujuan tidak diketahui')
        ]);

        return redirect()->route('stock-out.index')->with('success', 'Stok berhasil dikeluarkan!');
    }
}