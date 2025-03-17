<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Http\Resources\WisataResource;

class WisataController extends Controller
{
    public function index()
    {
        $wisata = Wisata::latest()->paginate(5);
        return new WisataResource(true, 'daftar wisata', $wisata);
    }
}
