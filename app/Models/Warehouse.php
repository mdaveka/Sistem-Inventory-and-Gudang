<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    // Tambahkan baris ini juga
    protected $fillable = [
        'name', 
        'location'
    ];
}