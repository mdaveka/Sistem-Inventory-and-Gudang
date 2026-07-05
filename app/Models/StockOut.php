<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    protected $fillable = ['item_id', 'warehouse_id', 'qty', 'date_out', 'user_id', 'destination'];

    public function item() { return $this->belongsTo(Item::class); }
    public function warehouse() { return $this->belongsTo(Warehouse::class); }
    public function user() { return $this->belongsTo(User::class); }
}