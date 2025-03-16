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
        Schema::create('tempat_wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->decimal('rating', 3, 2)->default(0);
            $table->string('thumbnail')->nullable();
            $table->json('gambar')->nullable();
            $table->json('fasilitas')->nullable();
            $table->decimal('harga_tiket', 10, 2)->nullable();
            $table->string('hari_operasional')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempat_wisata');
    }
};
