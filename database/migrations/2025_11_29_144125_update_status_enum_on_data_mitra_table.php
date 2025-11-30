<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('data_mitra', function (Blueprint $table) {
            DB::statement("ALTER TABLE data_mitra MODIFY COLUMN status ENUM('Proses','Diterima','Ditolak') NULL DEFAULT 'Proses'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_mitra', function (Blueprint $table) {
            DB::statement("ALTER TABLE data_mitra MODIFY COLUMN status ENUM('Proses','Diterima') NULL DEFAULT 'Proses'");
        });
    }
};
