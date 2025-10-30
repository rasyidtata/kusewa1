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
        Schema::create('data_mitra', function (Blueprint $table) {
            $table->id('id_mitra');
            
            $table->text('keperluan')->nullable();
            $table->enum('Jenis', ['Perorangan','Perusahaan'])->nullable()->default('Perorangan');
            $table->enum('status', ['Proses','Diterima'])->nullable()->default('Proses');

            $table->string('no_identitas', 50)->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('email', 100)->nullable();

            $table->date('tgl_perjanjian')->nullable();
            $table->date('masa_berlaku_identitas')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_tlpn', 20)->nullable();
            $table->string('foto_identitas')->nullable();

            $table->string('nama_perwakilan', 100)->nullable();
            $table->string('penyewa_selaku', 100)->nullable();
            $table->string('kota_penyewa', 100)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('fax_penyewa', 20)->nullable();
            $table->string('npwp', 50)->nullable();
            $table->string('no_penetapan_pengadilan', 100)->nullable();
            $table->date('tgl_penetapan_pengadilan')->nullable();
            $table->string('no_izin_berusaha', 100)->nullable();
            $table->date('tgl_izin_usaha')->nullable();
            $table->string('sk_dirjen_pajak', 100)->nullable();
            $table->date('tgl_sk_dirjen_pajak')->nullable();
            $table->string('surat_pengukuhan_kena_pajak', 100)->nullable();
            $table->date('tgl_surat_pengukuhan_kena_pajak')->nullable();
            $table->string('no_akta_pendirian', 100)->nullable();
            $table->date('tgl_akta_pendirian')->nullable();
            $table->string('no_anggaran_dasar', 100)->nullable();
            $table->date('tgl_anggaran_dasar')->nullable();
            $table->string('no_kenmenhum_dan_ham', 100)->nullable();
            $table->date('tgl_persetujuan_kenmenhum_dan_ham')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_mitra');
    }
};
