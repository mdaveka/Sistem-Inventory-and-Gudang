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
    Schema::create('stock_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
        $table->enum('type', ['IN', 'OUT', 'MUTASI']); // Jenis pergerakan stok
        $table->integer('qty');
        $table->foreignId('user_id')->constrained('users')->comment('Pelaku aktivitas');
        $table->text('description')->nullable(); // Contoh: "Dipindah dari Gudang A ke Gudang B"
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_logs');
    }
};
