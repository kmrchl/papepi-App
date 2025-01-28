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
        $validated = $request->validate([
            'id_karyawan' => 'required|integer',
            'jam_masuk' => 'required|date',
            'jam_keluar' => 'required|date|after_or_equal:jam_masuk',
        ]);

        $jamMasuk = strtotime($validated['jam_masuk']);
        $jamKeluar = strtotime($validated['jam_keluar']);
        $totalJam = ($jamKeluar - $jamMasuk) / 3600; // Hasil dalam jam

        $absen = Absensi::create([
            'id_karyawan' => $validated['id_karyawan'],
            'jam_masuk' => $validated['jam_masuk'],
            'jam_keluar' => $validated['jam_keluar'],
            'jam_kerja' => round($totalJam, 2), // Simpan hasilnya
        ]);

        return response()->json(['message' => 'Data berhasil disimpan', 'data' => $absen]);
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
