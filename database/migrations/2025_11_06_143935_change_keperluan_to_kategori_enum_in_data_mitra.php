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
            // Hapus kolom lama
            $table->dropColumn('keperluan');
        });

        Schema::table('data_mitra', function (Blueprint $table) {
            // Tambahkan kolom baru bernama `kategori` dengan enum Aset/Event
            $table->enum('kategori', ['Aset', 'Event'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_mitra', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });

        Schema::table('data_mitra', function (Blueprint $table) {
            $table->text('keperluan')->nullable();
        });
    }
};
