<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Models\Admin;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin/add', [AdminController::class, 'store']);
// Route::post('/users/add', function () {
//     return response()->json([
//         'message' => 'Route ada dan bisa dijalankan!'
//     ]);
// });


Route::get('/karyawan', [KaryawanController::class, 'index']);
Route::get('/karyawan/{id_karyawan}', [KaryawanController::class, 'show']);
Route::post('/karyawan/add', [KaryawanController::class, 'store']);
Route::put('/karyawan/update/{id_karyawan}', [KaryawanController::class, 'update']);
Route::delete('/karyawan/delete/{id_karyawan}', [KaryawanController::class, 'destroy']);



route::get('/absen', [AbsensiController::class, 'index']);
route::get('/absen/{id_absen}', [AbsensiController::class, 'show']);
route::get('/absen/detail/{id_karyawan}', [AbsensiController::class, 'detail']);
route::post('/absen/add', [AbsensiController::class, 'store']);



route::get('/gaji', [GajiController::class, 'index']);
route::get('/gaji/{id_gaji}', [GajiController::class, 'show']);
route::get('/gaji/detail/{id_karyawan}', [GajiController::class, 'detail']);
route::post('/gaji/add', [GajiController::class, 'store']);
route::put('/gaji/update/{id_gaji}', [GajiController::class, 'update']);
route::delete('/gaji/delete/{id_gaji}', [GajiController::class, 'destroy']);
