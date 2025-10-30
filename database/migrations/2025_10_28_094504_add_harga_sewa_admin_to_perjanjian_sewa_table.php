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
            $table->decimal('harga_sewa_admin', 15, 0)->nullable()->after('biaya_admin_ukur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perjanjian_sewa', function (Blueprint $table) {
            //
        });
    }
};
