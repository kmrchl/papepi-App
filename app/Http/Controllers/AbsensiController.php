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

    public function detail($id_karyawan)
    {
        $absen = absensi::where('id_karyawan', $id_karyawan)->get();

        if ($absen->isEmpty()) {
            return response()->json([
                'message' => 'data Absen tidak ditemukan untuk karyawan dengan ID tersebut',
            ], 404);
        }

        return response()->json([
            'message' => 'Data absensi berhasil ditemukan',
            'data' => $absen
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'jam_masuk' => 'required|date',
            'jam_keluar' => 'nullable|date|after_or_equal:jam_masuk', // harus setelah jam masuk
            'jam_kerja' => 'required|integer|min:0', // Waktu kerja dalam jam
        ]);

        // Simpan data absensi
        $absensi = absensi::create([
            'id_karyawan' => $validatedData['id_karyawan'],
            'jam_masuk' => $validatedData['jam_masuk'],
            'jam_keluar' => $validatedData['jam_keluar'] ?? null,
            'jam_kerja' => $validatedData['jam_kerja'],
        ]);

        return response()->json([
            'message' => 'Data absensi berhasil ditambahkan',
            'data' => $absensi
        ], 201); // 201 adalah status code untuk "Created"
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
