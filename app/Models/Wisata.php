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
        'rating_rata_rata',
        'fasilitas',
        'harga_tiket',
        'jam_operasional'
    ];
}
