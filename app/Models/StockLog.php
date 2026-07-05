<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    protected $fillable = ['item_id', 'type', 'qty', 'user_id', 'description'];

    // Relasi ke tabel barang
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // TAMBAHKAN RELASI INI AGAR DASHBOARD & LAPORAN TIDAK ERROR
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}