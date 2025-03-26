<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Http\Resources\WisataResource;
use Illuminate\Support\Facades\Validator;

class WisataController extends Controller
{
    public function index()
    {
        $wisata = Wisata::latest()->paginate(5);
        return new WisataResource(true, 'Daftar wisata', $wisata);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_wisata' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'required|string|max:255',
            'kategori_wisata' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'gambar' => 'nullable|string',
            'fasilitas' => 'nullable|string',
            'harga_tiket' => 'required|numeric|min:0',
            'hari_operasional' => 'required|string',
            'jam_operasional' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $wisata = Wisata::create($request->all());

        return new WisataResource(true, 'Wisata berhasil ditambahkan!', $wisata);
    }

    public function show($id)
    {
        $wisata = Wisata::findOrFail($id);
        return new WisataResource(true, 'Detail wisata', $wisata);
    }

    public function update(Request $request, $id)
    {
        $wisata = Wisata::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_wisata' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'sometimes|required|string|max:255',
            'kategori_wisata' => 'sometimes|required|string|max:255',
            'rating' => 'sometimes|required|numeric|min:0|max:5',
            'gambar' => 'nullable|string',
            'fasilitas' => 'nullable|string',
            'harga_tiket' => 'nullable|numeric|min:0',
            'hari_operasional' => 'sometimes|required|string',
            'jam_operasional' => 'sometimes|required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $wisata->update($request->all());

        return new WisataResource(true, 'Wisata berhasil diperbarui!', $wisata);
    }

    public function destroy($id)
    {
        $wisata = Wisata::findOrFail($id);
        $wisata->delete();

        return new WisataResource(true, 'Wisata berhasil dihapus!', $wisata);
    }
}
