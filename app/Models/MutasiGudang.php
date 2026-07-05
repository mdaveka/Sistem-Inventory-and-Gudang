<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutasiGudang extends Model
{
    use HasFactory;

  protected $fillable = [
    'barang_id',
    'gudang_asal_id',
    'gudang_tujuan_id',
    'jumlah',
    'tanggal_mutasi' 
];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function gudangAsal()
    {
        return $this->belongsTo(Gudang::class, 'gudang_asal_id');
    }

    public function gudangTujuan()
    {
        return $this->belongsTo(Gudang::class, 'gudang_tujuan_id');
    }
}