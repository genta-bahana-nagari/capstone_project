<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Http\Resources\BaseResource;
use Illuminate\Support\Facades\Validator;

class WisataController extends Controller
{
    public function index()
    {
        $wisata = Wisata::latest()->paginate(5);
        return new BaseResource(true, 'daftar wisata', $wisata);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_wisata' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'kategori_wisata' => 'required|string|max:255',
            'rating_rata_rata' => 'required|numeric|min:0|max:5',
            'fasilitas' => 'nullable|string',
            'harga_tiket' => 'nullable|numeric|min:0',
            'jam_operasional' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $wisata = Wisata::create([
            'nama_wisata' => $request->nama_wisata,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'kategori_wisata' => $request->kategori_wisata,
            'rating_rata_rata' => $request->rating_rata_rata,
            'fasilitas' => $request->fasilitas,
            'harga_tiket' => $request->harga_tiket,
            'jam_operasional' => $request->jam_operasional
        ]);
        return new BaseResource(true, 'wisata berhasil ditambahkan!', $wisata);
    }

    public function show($id)
    {
        $wisata = Wisata::find($id);

        if (!$wisata) {
            return response()->json([
                'success' => false,
                'message' => 'wisata tidak ditemukan'
            ], 404);
        }

        return new BaseResource(true, 'detail wisata', $wisata);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_wisata' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|required|string',
            'lokasi' => 'sometimes|required|string|max:255',
            'kategori_wisata' => 'sometimes|required|string|max:255',
            'rating_rata_rata' => 'sometimes|required|numeric|min:0|max:5',
            'fasilitas' => 'nullable|string',
            'harga_tiket' => 'nullable|numeric|min:0',
            'jam_operasional' => 'sometimes|required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $wisata = Wisata::find($id);

        if (!$wisata) {
            return response()->json([
                'success' => false,
                'message' => 'wisata tidak ditemukan'
            ], 404);
        }

        $wisata->update($request->all());

        return new BaseResource(true, 'wisata berhasil diupdate', $wisata);
    }

    public function destroy($id)
    {
        $wisata = Wisata::find($id);

        if (!$wisata) {
            return response()->json([
                'success' => false,
                'message' => 'wisata tidak ditemukan'
            ], 404);
        }

        $wisata->delete();

        return new BaseResource(true, 'wisata berhasil dihapus', $wisata);
    }
}
