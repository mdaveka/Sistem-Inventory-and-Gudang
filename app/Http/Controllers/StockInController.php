<?php
namespace App\Http\Controllers;

use App\Models\{StockIn, StockLog, Item, Warehouse};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockInController extends Controller {
    public function index() {
        $stockIns = StockIn::with(['item', 'warehouse'])->latest()->get();
        $items = Item::all();
        $warehouses = Warehouse::all();
        return view('stock_in.index', compact('stockIns', 'items', 'warehouses'));
    }

    public function store(Request $request) {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'qty' => 'required|integer|min:1|max:1500',
            'date_in' => 'required|date',
        ]);

        // 1. Catat Transaksi Masuk
        $stockIn = StockIn::create($request->all() + ['user_id' => Auth::id()]);

        // 2. UPDATE STOK BARANG (INCREMENT)
        $item = Item::findOrFail($request->item_id);
        $item->increment('stock', $request->qty);

        // 3. Catat di Log Aktivitas Global
        StockLog::create([
            'item_id' => $item->id,
            'type' => 'IN',
            'qty' => $request->qty,
            'user_id' => Auth::id(),
            'description' => "Penerimaan barang di " . $stockIn->warehouse->name
        ]);

        return redirect()->back()->with('success', 'Stok berhasil masuk dan diupdate!');
    }
}
