<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'wisata';

    protected $fillable = [
        'nama_wisata',
        'deskripsi',
        'lokasi',
        'kategori_wisata',
        'rating',
        'gambar',
        'fasilitas',
        'harga_tiket',
        'hari_operasional',
        'jam_operasional'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }
}