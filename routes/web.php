<?php

use Illuminate\Support\Facades\Route;
use App\Models\Barang;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barang', function () {
    $barang = Barang::all();
    return view('barang', compact('barang'));
});