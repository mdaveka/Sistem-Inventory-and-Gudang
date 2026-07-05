<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMutation extends Model
{
    protected $fillable = [
        'item_id', 
        'from_warehouse_id', 
        'to_warehouse_id', 
        'qty', 
        'user_id', 
        'note'
    ];

    public function item() { return $this->belongsTo(Item::class); }
    public function from_warehouse() { return $this->belongsTo(Warehouse::class, 'from_warehouse_id'); }
    public function to_warehouse() { return $this->belongsTo(Warehouse::class, 'to_warehouse_id'); }
    public function user() { return $this->belongsTo(User::class); }
}
