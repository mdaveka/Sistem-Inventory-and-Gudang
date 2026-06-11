<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->foreignId('supplier_id')->constrained()->after('harga');
            $table->foreignId('gudang_id')->constrained()->after('supplier_id');
        });
    }

    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['gudang_id']);
            $table->dropColumn(['supplier_id', 'gudang_id']);
        });
    }
};
