<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return ['Laravel' => app()->version()];
// });

// require __DIR__.'/auth.php';



// LOGIN ADMIN
// Route::middleware('auth')->group(function () {
//     Route::get('/admin', function () {
//         return view('admin.index');
//     })->name('admin.dashboard');
// });

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// ADMIN
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');


// KARYAWAN
Route::get('/karyawan', function () {
    return view('karyawan.index');
})->name('karyawan.index');

Route::get('/karyawan/detail/{id_karyawan}', function () {
    return view('karyawan.detail');
})->name('karyawan.detail');


// GAJI
Route::get('/gaji', function () {
    return view('gaji.index');
})->name('gaji.index');
