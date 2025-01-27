<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
route::get('/karyawan/{id_karyawan}', [KaryawanController::class, 'show'])->name('karyawan.show');
route::post('/karyawan/add', [KaryawanController::class, 'store'])->name('karyawan.add');
Route::put('/karyawan/update/{id_karyawan}', [KaryawanController::class, 'update']);
Route::delete('/karyawan/delete/{id_karyawan}', [KaryawanController::class, 'destroy']);




route::get('/absen', [AbsensiController::class, 'index'])->name('absen.index');
