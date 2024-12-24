<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    // Mendapatkan semua data Dosen
    public function index()
    {
        return response()->json(Dosen::all(), 200);
    }
    
    // Menyimpan data Dosen baru
    public function store(Request $request)
    {
        $dosen = Dosen::create($request->all());
        return response()->json($dosen, 201);
    }
    
    // Menampilkan data Dosen berdasarkan ID
    public function show($id)
    {
        return response()->json(Dosen::findOrFail($id), 200);
    }
    
    // Memperbarui data Dosen
    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->update($request->all());
        return response()->json($dosen, 200);
    }
    
    // Menghapus data Dosen
    public function destroy($id)
    {
        Dosen::destroy($id);
        return response()->json(null, 204);
    }
}

