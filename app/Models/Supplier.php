<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    // Tambahkan baris ini untuk mengizinkan penyimpanan data
    protected $fillable = [
        'name', 
        'phone', 
        'address'
    ];
}