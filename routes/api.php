<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MakulController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index']);//lihat data
    Route::post('/mahasiswa', [MahasiswaController::class, 'store']);//tambah data
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);//lihat menurut id
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update']);//edit menurut id
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy']);//hapus menurut id
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('dosens', DosenController::class);
    Route::apiResource('mahasiswas', MahasiswaController::class);
    Route::apiResource('makuls', MakulController::class);

    Route::get('makul/{kode_makul}/dosens', [MakulController::class, 'getDosensByMakul']);
});