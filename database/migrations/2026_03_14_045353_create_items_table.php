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
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->string('barcode')->unique()->nullable(); // Support Barcode
        $table->string('name');
        $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
        $table->integer('stock')->default(0);
        $table->integer('min_stock')->default(10); //Minimum Stock Alert
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
