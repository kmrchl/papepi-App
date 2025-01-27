<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absen = absensi::all();

        return response()->json([
            'message' => 'Data berhasil ditangkap',
            'data' => $absen
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(absensi $id_absen)
    {
        $absen = absensi::find($id_absen);

        return response()->json([
            'message' => 'data berhasil ditangkap',
            'data' => $absen
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'id_karyawan' => 'required|string|max:255',
            'notelp' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:karyawan',
            'alamat' => 'nullable|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'jenis_kelamin' => 'required|string',
            'fingerprint' => 'nullable|string|max:255',
            'gambar_profil' => 'nullable|string|max:255',
        ]);

        // Menyimpan data karyawan ke tabel 'karyawan'
        $karyawan = new absensi();
        $karyawan->nama = $validated['nama'];
        $karyawan->notelp = $validated['notelp'];
        $karyawan->email = $validated['email'];
        $karyawan->alamat = $validated['alamat'];
        $karyawan->posisi = $validated['posisi'];
        $karyawan->jenis_kelamin = $validated['jenis_kelamin'];
        $karyawan->fingerprint = $validated['fingerprint'];
        $karyawan->gambar_profil = $validated['gambar_profil'];

        // Simpan data ke database
        $karyawan->save();

        // Response JSON setelah data berhasil disimpan
        return response()->json([
            'message' => 'Data karyawan berhasil ditambahkan',
            'data' => $karyawan
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
