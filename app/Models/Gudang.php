<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_gudang',
        'lokasi',
        'kapasitas'
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }

    public function mutasiAsal()
    {
        return $this->hasMany(MutasiGudang::class, 'gudang_asal_id');
    }

    public function mutasiTujuan()
    {
        return $this->hasMany(MutasiGudang::class, 'gudang_tujuan_id');
    }
}