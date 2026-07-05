<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockLog;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    // 1. Fitur Minimum Stock Alert
    public function alert()
    {
        $alerts = Item::with('supplier')
                    ->whereColumn('stock', '<=', 'min_stock')
                    ->get();
                    
        return view('monitoring.alert', compact('alerts'));
    }

    // 2. Fitur Laporan Aktivitas (Buku Besar)
    public function laporan()
    {
        $logs = StockLog::with(['item', 'user'])->latest()->get();
        return view('monitoring.laporan', compact('logs'));
    }

    // 3. FITUR BARU: Export Laporan ke Excel (CSV)
    public function exportExcel()
    {
        $logs = StockLog::with(['item', 'user'])->latest()->get();
        $filename = "Laporan_Aktivitas_Gudang_" . date('Y-m-d') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Header Kolom Excel
        $columns = ['No', 'Tanggal', 'Waktu', 'Tipe Transaksi', 'Nama Barang', 'Jumlah (Qty)', 'Keterangan', 'Dilakukan Oleh'];

        $callback = function() use($logs, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns); // Tulis header

            foreach ($logs as $index => $log) {
                $row['No']       = $index + 1;
                
                // Mencegah error jika created_at bernilai null di database
                $row['Tanggal']  = $log->created_at ? $log->created_at->format('Y-m-d') : '-';
                $row['Waktu']    = $log->created_at ? $log->created_at->format('H:i:s') : '-';
                
                $row['Tipe']     = $log->type;
                $row['Barang']   = $log->item->name ?? 'Barang Dihapus';
                $row['Qty']      = $log->qty;
                $row['Ket']      = $log->description ?? '-';
                $row['Oleh']     = $log->user->name ?? 'System';

                fputcsv($file, array($row['No'], $row['Tanggal'], $row['Waktu'], $row['Tipe'], $row['Barang'], $row['Qty'], $row['Ket'], $row['Oleh']));
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}