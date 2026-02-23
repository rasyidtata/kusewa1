<?php
// database/migrations/[timestamp]_add_nama_aset_to_data_aset_table.php

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
        Schema::table('data_aset', function (Blueprint $table) {
            $table->string('nama_aset', 100)->nullable()->after('kode_aset');
            // atau jika tidak boleh null:
            // $table->string('nama_aset', 255)->after('kode_aset');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_aset', function (Blueprint $table) {
            $table->dropColumn('nama_aset');
        });
    }
};