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
            $table->enum('status_persetujuan', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->boolean('persetujuan_kai')->default(false);
            $table->boolean('persetujuan_mitra')->default(false);
            $table->timestamp('tanggal_persetujuan')->nullable();
            $table->text('catatan_penolakan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perjanjian_sewa', function (Blueprint $table) {
            $table->dropColumn([
                'status_persetujuan',
                'persetujuan_kai', 
                'persetujuan_mitra',
                'tanggal_persetujuan',
                'catatan_penolakan'
            ]);
        });
    }
};
