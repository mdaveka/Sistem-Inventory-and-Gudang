<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mutasi_gudangs', function (Blueprint $table) {
            $table->date('tanggal_mutasi')->after('jumlah')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('mutasi_gudangs', function (Blueprint $table) {
            $table->dropColumn('tanggal_mutasi');
        });
    }
};