<?php

namespace App\Http\Controllers;

use App\Models\Makul;
use Illuminate\Http\Request;

class MakulController extends Controller
{
    // Mendapatkan semua data Mata Kuliah
    public function index()
    {
        return response()->json(Makul::all(), 200);
    }

    // Menyimpan data Mata Kuliah baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'kode_makul' => 'required|string|unique:makuls,kode_makul',
            'nama_makul' => 'required|string|max:255',
            'sks' => 'required|integer|min:1',
        ]);

        $makul = Makul::create($request->all());
        return response()->json($makul, 201);
    }

    // Menampilkan data Mata Kuliah berdasarkan kode_makul
    public function show($kode_makul)
    {
        $makul = Makul::findOrFail($kode_makul);
        return response()->json($makul, 200);
    }

    // Memperbarui data Mata Kuliah
    public function update(Request $request, $kode_makul)
    {
        // Validasi data
        $request->validate([
            'nama_makul' => 'sometimes|string|max:255',
            'sks' => 'sometimes|integer|min:1',
        ]);

        $makul = Makul::findOrFail($kode_makul);
        $makul->update($request->all());
        return response()->json($makul, 200);

    }

    // Menghapus data Mata Kuliah
    public function destroy($kode_makul)
    {
        Makul::destroy($kode_makul);
        return response()->json(null, 204);

    }
    

    public function getDosensByMakul($kode_makul)
    {
        $makul = Makul::where('kode_makul', $kode_makul)->with('dosens')->first();

        if ($makul) {
            return response()->json($makul->dosens);
        }

        return response()->json(['message' => 'Mata kuliah tidak ditemukan'], 404);
    }
}
