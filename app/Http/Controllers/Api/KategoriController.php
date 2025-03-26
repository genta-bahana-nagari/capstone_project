<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Http\Resources\KategoriResource;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::latest()->paginate(5);
        return new KategoriResource(true, 'Daftar kategori wisata', $kategori);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kategori = Kategori::create($request->all());

        return new KategoriResource(true, 'Kategori berhasil ditambahkan!', $kategori);
    }

    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        return new KategoriResource(true, 'Detail kategori', $kategori);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kategori' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kategori->update($request->all());

        return new KategoriResource(true, 'Kategori berhasil diperbarui!', $kategori);
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return new KategoriResource(true, 'Kategori berhasil dihapus!', $kategori);
    }
}
