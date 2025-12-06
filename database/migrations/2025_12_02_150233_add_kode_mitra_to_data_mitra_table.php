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
        Schema::table('data_mitra', function (Blueprint $table) {
            $table->string('kode_mitra', 20)->unique()->nullable()->after('id_mitra');
            $table->index('kode_mitra');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_mitra', function (Blueprint $table) {
            $table->dropColumn('kode_mitra');
        });
    }
};
