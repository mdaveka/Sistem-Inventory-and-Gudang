<?php

use Illuminate\Support\Facades\Route;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Gudang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Http\Controllers\AdminController\AuthController as AdminAuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

Route::get('/', function () {
    $lowStockLimit = 5;
    $lowStockItems = Barang::query()
        ->where('stok', '<=', $lowStockLimit)
        ->orderBy('stok')
        ->take(5)
        ->get();

    $incomingActivities = BarangMasuk::query()
        ->with('barang')
        ->latest()
        ->take(5)
        ->get()
        ->map(fn ($item) => [
            'type' => 'Stok Masuk',
            'tone' => 'success',
            'item' => optional($item->barang)->nama_barang ?? 'Barang',
            'quantity' => $item->jumlah,
            'user' => 'Admin Utama',
            'time' => optional($item->created_at)->diffForHumans() ?? '-',
            'created_at' => $item->created_at,
        ]);

    $outgoingActivities = BarangKeluar::query()
        ->with('barang')
        ->latest()
        ->take(5)
        ->get()
        ->map(fn ($item) => [
            'type' => 'Stok Keluar',
            'tone' => 'danger',
            'item' => optional($item->barang)->nama_barang ?? 'Barang',
            'quantity' => $item->jumlah,
            'user' => 'Admin Utama',
            'time' => optional($item->created_at)->diffForHumans() ?? '-',
            'created_at' => $item->created_at,
        ]);

    $recentActivities = $incomingActivities
        ->merge($outgoingActivities)
        ->sortByDesc('created_at')
        ->take(5)
        ->values();

    return view('welcome', [
        'totalBarang' => Barang::count(),
        'totalSupplier' => Supplier::count(),
        'gudangAktif' => Gudang::count(),
        'aktivitasHariIni' => BarangMasuk::whereDate('created_at', today())->count()
            + BarangKeluar::whereDate('created_at', today())->count(),
        'lowStockItems' => $lowStockItems,
        'lowStockLimit' => $lowStockLimit,
        'recentActivities' => $recentActivities,
    ]);
});

Route::get('/barang', function () {
    $barang = Barang::all();
    return view('barang', compact('barang'));
});

Route::resource('supplier', SupplierController::class);
Route::resource('gudang', GudangController::class);
Route::resource('barang-masuk', BarangMasukController::class);
Route::resource('barang-keluar', BarangKeluarController::class);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::get('/register', [AdminAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AdminAuthController::class, 'register']);
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->middleware('auth')->name('logout');
});
