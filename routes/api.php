<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KaryawanController;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
route::get('/karyawan/{id_karyawan}', [KaryawanController::class, 'show'])->name('karyawan.show');
route::post('/karyawan/add', [KaryawanController::class, 'store'])->name('karyawan.add');
Route::put('/karyawan/update/{id_karyawan}', [KaryawanController::class, 'update']);
Route::delete('/karyawan/delete/{id_karyawan}', [KaryawanController::class, 'destroy']);




route::get('/absen', [AbsensiController::class, 'index'])->name('absen.index');
route::get('/absen/{id_absen}', [AbsensiController::class, 'show'])->name('absen.show');
route::get('/absen/detail/{id_karyawan}', [AbsensiController::class, 'detail'])->name('absen.detail');
route::post('/absen/add', [AbsensiController::class, 'store'])->name('absen.add');



route::get('/gaji', [GajiController::class, 'index'])->name('gaji.index');
route::get('/gaji/{id_gaji}', [GajiController::class, 'show'])->name('gaji.show');
route::get('/gaji/detail/{id_karyawan}', [GajiController::class, 'detail'])->name('gaji.detail');
route::post('/gaji/add', [GajiController::class, 'store'])->name('gaji.add');
route::put('/gaji/update/{id_gaji}', [GajiController::class, 'update'])->name('gaji.update');
route::delete('/gaji/delete/{id_gaji}', [GajiController::class, 'destroy'])->name('gaji.delete');
