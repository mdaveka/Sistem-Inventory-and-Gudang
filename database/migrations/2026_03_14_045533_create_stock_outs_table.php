<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('stock_outs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
        $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
        $table->integer('qty');
        $table->date('date_out');
        $table->foreignId('user_id')->constrained('users')->comment('Admin/User yang mengeluarkan');
        $table->text('destination')->nullable(); // Tujuan barang keluar
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_outs');
    }
};
