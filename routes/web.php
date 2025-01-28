<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return ['Laravel' => app()->version()];
// });

// require __DIR__.'/auth.php';


// ADMIN
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');



// KARYAWAN
Route::get('/karyawan', function () {
    return view('karyawan.index');
})->name('karyawan.index');


// GAJI
Route::get('/gaji', function () {
    return view('gaji.index');
})->name('gaji.index');
