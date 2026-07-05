<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\StockMutationController;
use App\Http\Controllers\MonitoringController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::resource('items', ItemController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('warehouse', WarehouseController::class);

    // Transaksi
    Route::resource('stock-in', StockInController::class)->only(['index', 'store']);
    Route::resource('stock-out', StockOutController::class)->only(['index', 'store']);
    Route::resource('mutasi', StockMutationController::class)->only(['index', 'store']);

    // Manajemen Pengguna
    Route::resource('users', App\Http\Controllers\UserController::class);

    // Menu Data Barang
    Route::post('/items/print-barcode', [App\Http\Controllers\ItemController::class, 'printBarcode'])->name('items.print_barcode');
    Route::resource('items', App\Http\Controllers\ItemController::class);

    // Monitoring
    Route::get('/monitoring/alert', [MonitoringController::class, 'alert'])->name('monitoring.alert');
    Route::get('/monitoring/laporan', [MonitoringController::class, 'laporan'])->name('monitoring.laporan');

    // PASTIKAN BARIS INI ADA UNTUK EXPORT EXCEL:
    Route::get('/monitoring/export-excel', [MonitoringController::class, 'exportExcel'])->name('monitoring.export');

    // Profile Bawaan Laravel Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';