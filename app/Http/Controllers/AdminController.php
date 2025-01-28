<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $admin = Admin::all();

        if ($admin->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada data'
            ], 404);
        } else {
            return response()->json([
                'message' => 'Data berhasil ditangkap',
                'data' => $admin
            ]);
        }
    }
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admin',
            'password' => 'required|string'
        ]);

        // Buat user baru
        $user = Admin::create([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        // Response
        return response()->json([
            'message' => 'Admin berhasil ditambahkan',
            'data' => $user,
        ], 201);
    }
}
