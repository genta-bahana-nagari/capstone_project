<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\Wisata;
use app\Http\Resources\WisataResource;

class WisataController extends Controller
{
    public function index()
    {
        $wisata = Wisata::latest()->paginate(5);
        return new WisataResource(true, 'daftar wisata', $wisata);
    }
}
