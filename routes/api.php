<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

Route::post('/login', [AuthController::class, 'login']) ->name('login');
Route::post('/register', [AuthController::class, 'register']);

Route::apiResource('barangs', App\Http\Controllers\BarangController::class);
Route::apiResource('suppliers', App\Http\Controllers\SupplierController::class);
Route::apiResource('gudangs', App\Http\Controllers\GudangController::class);
Route::apiResource('mutasi-gudangs', App\Http\Controllers\MutasiGudangController::class);

Route::post('/stok-masuk', [BarangMasukController::class, 'store']);
Route::post('/stok-keluar', [BarangKeluarController::class, 'store']);
