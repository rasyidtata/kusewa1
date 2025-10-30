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
        Schema::create('data_aset', function (Blueprint $table) {
            $table->id('id_aset');
            $table->text('lokasi');
            $table->decimal('luas_tanah', 10, 2);
            $table->decimal('luas_bangunan', 10, 2)->nullable();
            $table->string('penggunaan_objek', 200);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_aset');
    }
};
