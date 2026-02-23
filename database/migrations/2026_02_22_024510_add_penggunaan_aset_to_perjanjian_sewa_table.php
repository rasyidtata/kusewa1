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
        Schema::table('perjanjian_sewa', function (Blueprint $table) {
            $table->string('penggunaan_aset', 100)->nullable()->after('status');
            // Sesuaikan tipe data sesuai kebutuhan, misal:
            // $table->enum('penggunaan_aset', ['komersial', 'sosial', 'lainnya'])->nullable()->after('status');
            // $table->text('penggunaan_aset')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perjanjian_sewa', function (Blueprint $table) {
            $table->dropColumn('penggunaan_aset');
        });
    }
};