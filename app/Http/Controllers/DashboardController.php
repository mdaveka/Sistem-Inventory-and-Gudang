<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\Warehouse;
use App\Models\StockLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik Atas
        $total_items = Item::count();
        $total_suppliers = Supplier::count();
        $total_warehouses = Warehouse::count();
        $activity_today = StockLog::whereDate('created_at', Carbon::today())->count();

        // 2. Minimum Stock Alert (Ambil maksimal 5 barang yang mau habis)
        $alerts = Item::whereColumn('stock', '<=', 'min_stock')->take(5)->get();

        // 3. Log Aktivitas Terbaru (Ambil 5 aktivitas terakhir)
        $recent_logs = StockLog::with(['item', 'user'])->latest()->take(5)->get();

        return view('dashboard', compact(
            'total_items', 
            'total_suppliers', 
            'total_warehouses', 
            'activity_today',
            'alerts',
            'recent_logs'
        ));
    }
}
