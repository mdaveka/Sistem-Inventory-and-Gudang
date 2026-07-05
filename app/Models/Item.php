<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Mengizinkan penyimpanan data
    protected $fillable = [
        'barcode', 
        'name', 
        'supplier_id', 
        'stock', 
        'min_stock'
    ];

    // Relasi: 1 Barang memiliki 1 Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
