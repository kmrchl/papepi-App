<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $admin = User::all();
        return response()->json([
            'message' => 'data berhasil ditangkap',
            'data' => $admin
        ]);
    }


    public function show(User $id)
    {
        $admin = User::find($id);
        return response()->json([
            'message' => 'data berhasil ditangkap',
            'data' => $admin
        ]);

        if ($admin->isEmpty()) {
            return response()->json([
                'message' => 'ID yang dicari tidak ada.'
            ]);
        };
    }
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'email_verified_at' => null,
            'remember_token' => null
        ]);

        // Response
        return response()->json([
            'message' => 'User berhasil ditambahkan',
            'data' => $user,
        ], 201);
    }
}
