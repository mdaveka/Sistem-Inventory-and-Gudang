<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

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