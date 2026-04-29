<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $fillable = ['barang_id', 'supplier_id', 'gudang_id', 'jumlah', 'tanggal_masuk'];
}
