<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari admin berdasarkan email
        $admin = Admin::where('email', $request->email)->first();

        // Periksa apakah admin ada dan password sesuai
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Buat token untuk autentikasi
            $token = $admin->createToken('admin_token')->plainTextToken;

            return response()->json([
                'message' => 'Login berhasil',
                'token' => $token,
                'admin' => [
                    'id_admin' => $admin->id_admin,
                    'nama' => $admin->nama,
                    'email' => $admin->email,
                ],
            ], 200);
        }

        // Jika gagal
        return response()->json(['message' => 'Email atau password salah'], 401);
    }

    public function logout(Request $request)
    {
        // Hapus token autentikasi admin
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil',
        ], 200);
    }
}
