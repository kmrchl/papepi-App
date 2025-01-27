<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $karyawan = karyawan::all();

            return response()->json([
                'message' => 'Data berhasil ditangkap',
                'data' => $karyawan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(karyawan $id_karyawan)
    {
        $karyawan = karyawan::find($id_karyawan);

        return response()->json([
            "message" => 'Data berhasil ditangkap',
            "data" => $karyawan
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'notelp' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:karyawan',
            'alamat' => 'nullable|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'jenis_kelamin' => 'required|string',
            'fingerprint' => 'nullable|string|max:255',
            'gambar_profil' => 'nullable|string|max:255',
        ]);

        // Menyimpan data karyawan ke tabel 'karyawan'
        $karyawan = new Karyawan();
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
     * Show the form for editing the specified resource.
     */
    public function edit(karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_karyawan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'notelp' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:karyawan,email,' . $id_karyawan . ',id_karyawan',
            'alamat' => 'nullable|string|max:255',
            'posisi' => 'nullable|string|max:255',
            'jenis_kelamin' => 'required|string',
            'fingerprint' => 'nullable|string|max:255',
            'gambar_profil' => 'nullable|string|max:255',
        ]);

        $karyawan = Karyawan::find($id_karyawan);

        if (!$karyawan) {
            return response()->json([
                'message' => 'Karyawan tidak ditemukan'
            ], 404);
        }

        Log::info('Data sebelum update: ', $karyawan->toArray());

        $karyawan->update($validated);

        if ($karyawan->update($validated)) {
            Log::info('Data berhasil diperbarui: ', $karyawan->fresh()->toArray());
            return response()->json([
                'message' => 'Data karyawan berhasil diperbarui',
                'data' => $karyawan->fresh()
            ], 200);
        } else {
            Log::error('Gagal memperbarui data.');
            return response()->json([
                'message' => 'Gagal memperbarui data'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_karyawan)
    {
        // Cari karyawan berdasarkan id_karyawan
        $karyawan = Karyawan::find($id_karyawan);

        // Cek apakah karyawan ditemukan
        if (!$karyawan) {
            return response()->json([
                'message' => 'Karyawan tidak ditemukan'
            ], 404); // 404 adalah status code untuk "Not Found"
        }

        // Hapus data karyawan
        $karyawan->delete();

        return response()->json([
            'message' => 'Data karyawan berhasil dihapus',
            'data' => $karyawan
        ], 200); // 200 adalah status code untuk "OK"
    }
}
