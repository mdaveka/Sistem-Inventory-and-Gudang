<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\GudangController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/barang', [BarangController::class, 'index']);      // lihat semua barang
Route::post('/barang', [BarangController::class, 'store']);     // tambah barang
Route::get('/barang/{id}', [BarangController::class, 'show']);  // lihat 1 barang
Route::put('/barang/{id}', [BarangController::class, 'update']); // edit barang
Route::delete('/barang/{id}', [BarangController::class, 'destroy']); // hapus barang

Route::apiResource('barangs', BarangController::class);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('gudangs', GudangController::class);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/stok-masuk', [BarangMasukController::class, 'store']);
Route::post('/stok-keluar', [BarangKeluarController::class, 'store']);
