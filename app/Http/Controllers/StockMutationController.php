<?php

namespace App\Http\Controllers;

use App\Models\{StockMutation, StockLog, Item, Warehouse};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockMutationController extends Controller
{
    public function index()
    {
        $mutations = StockMutation::with(['item', 'from_warehouse', 'to_warehouse', 'user'])->latest()->get();
        $items = Item::all();
        $warehouses = Warehouse::all();
        return view('mutasi.index', compact('mutations', 'items', 'warehouses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'from_warehouse_id' => 'required|exists:warehouses,id',
            'to_warehouse_id' => 'required|exists:warehouses,id|different:from_warehouse_id',
            'qty' => 'required|integer|min:1|max:1500',
        ]);

        // LOGIKA KEAMANAN 1: Cegah mutasi ke gudang yang sama
        if ($request->from_warehouse_id === $request->to_warehouse_id) {
            return redirect()->back()
                ->withErrors(['to_warehouse_id' => 'GAGAL: Gudang asal dan gudang tujuan tidak boleh sama!'])
                ->withInput();
        }

        $item = Item::findOrFail($request->item_id);

        // LOGIKA KEAMANAN 2: Pastikan stok barang mencukupi untuk dimutasi
        if ($request->qty > $item->stock) {
            return redirect()->back()
                ->withErrors(['qty' => 'GAGAL: Stok tidak mencukupi untuk dimutasi! Sisa stok ' . $item->name . ' hanya ' . $item->stock . ' unit.'])
                ->withInput();
        }

        // Ambil data gudang untuk detail deskripsi log
        $fromWarehouse = Warehouse::find($request->from_warehouse_id);
        $toWarehouse = Warehouse::find($request->to_warehouse_id);

        // 2. Simpan Transaksi Mutasi menggunakan data bersih
        StockMutation::create([
            'item_id' => $request['item_id'],
            'from_warehouse_id' => $request['from_warehouse_id'],
            'to_warehouse_id' => $request['to_warehouse_id'],
            'qty' => $request['qty'],
            'user_id' => Auth::id(),
        ]);

        // 3. Catat di Log Aktivitas Global (History Log)
        StockLog::create([
            'item_id' => $request['item_id'],
            'type' => 'MUTASI',
            'qty' => $request['qty'],
            'user_id' => Auth::id(),
            'description' => "Mutasi barang dari " . ($fromWarehouse->name ?? 'Gudang Asal') . " ke " . ($toWarehouse->name ?? 'Gudang Tujuan')
        ]);

        return redirect()->route('mutasi.index')->with('success', 'Mutasi barang berhasil dilakukan!');
    }
}
