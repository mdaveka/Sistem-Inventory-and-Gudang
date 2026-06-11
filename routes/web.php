<?php

use Illuminate\Support\Facades\Route;
use App\Models\Barang;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\MutasiGudangController; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barang', function () {
    $barang = Barang::all();
    return view('barang', compact('barang'));
});

Route::resource('supplier', SupplierController::class);
Route::resource('gudang', GudangController::class);
Route::resource('barang-masuk', BarangMasukController::class);
Route::resource('barang-keluar', BarangKeluarController::class);
Route::resource('mutasi', MutasiGudangController::class); 
Route::get('/login', function () {
    return view('admin.auth.login');
})->name('login');

Route::get('/register', function () {
    return view('admin.auth.register');
})->name('register');