<?php
// database/migrations/[timestamp]_drop_penggunaan_objek_from_data_aset.php

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
            $table->dropColumn('penggunaan_objek');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_aset', function (Blueprint $table) {
            $table->string('penggunaan_objek')->nullable();
        });
    }
};