<?php

use Illuminate\Support\Facades\Route;
use App\Models\Barang;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\GudangController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barang', function () {
    $barang = Barang::all();
    return view('barang', compact('barang'));
});

Route::resource('supplier', SupplierController::class);
Route::resource('gudang', GudangController::class);