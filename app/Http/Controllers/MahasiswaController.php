<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
  
    // Menampilkan semua data mahasiswa
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return response()->json($mahasiswas);
    }

    // Menyimpan data mahasiswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string|unique:mahasiswas,nim',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jurusan' => 'required|string|max:255',
        ]);

        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json($mahasiswa, 201);
    }

    // Menampilkan detail data mahasiswa tertentu
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return response()->json($mahasiswa);
    }

    // Mengupdate data mahasiswa tertentu
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim' => 'required|string|unique:mahasiswas,nim,' . $id,
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jurusan' => 'required|string|max:255',
        ]);

        $mahasiswa->update($request->all());

        return response()->json($mahasiswa);
    }

    // Menghapus data mahasiswa tertentu
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return response()->json(['message' => 'Data mahasiswa deleted successfully']);
    }
}