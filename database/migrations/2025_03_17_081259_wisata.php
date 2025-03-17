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
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wisata');
            $table->text('deskripsi')->nullable();
            $table->string('lokasi');
            $table->string('kategori_wisata');
            $table->decimal('rating_rata_rata', 3, 2)->default(0.0);
            $table->text('fasilitas')->nullable();
            $table->decimal('harga_tiket', 10)->nullable();
            $table->string('jam_operasional');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
