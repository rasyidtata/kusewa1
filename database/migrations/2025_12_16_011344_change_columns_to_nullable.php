<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('data_aset', function (Blueprint $table) {
            DB::statement('ALTER TABLE data_aset MODIFY luas_tanah BIGINT UNSIGNED NULL');
        });

        Schema::table('perjanjian_sewa', function (Blueprint $table) {
            DB::statement('ALTER TABLE perjanjian_sewa MODIFY masa_awal_manfaat DATE NULL');
            DB::statement('ALTER TABLE perjanjian_sewa MODIFY masa_akhir_manfaat DATE NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nullable', function (Blueprint $table) {
            DB::statement('ALTER TABLE data_aset MODIFY luas_tanah BIGINT UNSIGNED NOT NULL');
        });

        Schema::table('perjanjian_sewa', function (Blueprint $table) {
            DB::statement('ALTER TABLE perjanjian_sewa MODIFY masa_awal_manfaat DATE NOT NULL');
            DB::statement('ALTER TABLE perjanjian_sewa MODIFY masa_akhir_manfaat DATE NOT NULL');
        });
    }
};
