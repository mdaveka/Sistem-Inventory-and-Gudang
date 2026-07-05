<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model {
    protected $fillable = ['item_id', 'warehouse_id', 'qty', 'date_in', 'user_id', 'note'];
    public function item() { return $this->belongsTo(Item::class); }
    public function warehouse() { return $this->belongsTo(Warehouse::class); }
    public function user() { return $this->belongsTo(User::class); }
}
