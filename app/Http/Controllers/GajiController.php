<?php

namespace App\Http\Controllers;

use App\Models\gaji;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gaji = gaji::all();

        if ($gaji->isEmpty()) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        }
        return response()->json(
            [
                'message' => 'data berhasil ditangkap',
                'data' => $gaji
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(gaji $id_gaji)
    {
        $gaji = gaji::find($id_gaji);

        if ($gaji->isEmpty()) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'data berhasil ditangkap',
            'data' => $gaji
        ]);
    }

    public function detail($id_karyawan)
    {
        $gaji = gaji::where('id_karyawan', $id_karyawan)->get();

        if ($gaji->isEmpty()) {
            return response()->json([
                'message' => 'data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'data berhasil ditangkap',
            'data' => $gaji
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'gaji' => 'required|numeric',
            'tunjangan' => 'nullable|numeric'
        ]);

        // Simpan data absensi
        $gaji = gaji::create([
            'id_karyawan' => $validatedData['id_karyawan'],
            'gaji' => $validatedData['gaji'],
            'tunjangan' => $validatedData['tunjangan']
        ]);

        return response()->json([
            'message' => 'Data gaji berhasil ditambahkan',
            'data' => $gaji
        ], 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_gaji)
    {
        // Validasi data
        $request->validate([
            'gaji' => 'nullable|numeric',
            'tunjangan' => 'nullable|numeric',
        ]);

        // Cari data gaji berdasarkan ID
        $gaji = gaji::find($id_gaji);

        if (!$gaji) {
            return response()->json([
                'message' => 'Data gaji tidak ditemukan',
            ], 404);
        }

        // Update data gaji
        $gaji->update($request->only(['gaji', 'tunjangan']));

        return response()->json([
            'message' => 'Data gaji berhasil diperbarui',
            'data' => $gaji
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_gaji)
    {
        // Cari data gaji berdasarkan ID
        $gaji = gaji::find($id_gaji);

        if (!$gaji) {
            return response()->json([
                'message' => 'Data gaji tidak ditemukan',
            ], 404);
        }

        // Hapus data gaji
        $gaji->delete();

        return response()->json([
            'message' => 'Data gaji berhasil dihapus',
        ], 200);
    }
}
