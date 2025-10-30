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
        Schema::create('perjanjian_sewa', function (Blueprint $table) {
            $table->id('id_perjanjian');    
            $table->string('jangka_waktu', 30);
            $table->date('masa_awal_perjanjian');
            $table->date('masa_akhir_perjanjian');
            $table->date('masa_awal_manfaat');
            $table->date('masa_akhir_manfaat');
            $table->decimal('harga_sewa', 15,0)->nullable();
            $table->decimal('harga_sewa_admin_com', 15,0)->nullable();
            $table->decimal('harga_pemanfaatan', 15,0)->nullable();
            $table->decimal('biaya_admin_ukur', 15,0)->nullable();
            $table->decimal('total_harga', 15,0)->nullable();
            $table->decimal('ppn_11_persen', 15,0)->nullable();
            $table->decimal('cost_of_money', 15,0)->nullable();
            $table->string('terbilang', 255)->nullable();
            $table->enum('status',['aktif','peringatan','mati'])->nullable();

            // Foreign key relationships
            $table->unsignedBigInteger('id_aset')->nullable();
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->unsignedBigInteger('id_mitra')->nullable();

            $table->foreign('id_aset')->references('id_aset')->on('data_aset')->onDelete('cascade');
            $table->foreign('id_admin')->references('id_admin')->on('admin')->onDelete('cascade');
            $table->foreign('id_mitra')->references('id_mitra')->on('data_mitra')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjanjian_sewa');
    }
};