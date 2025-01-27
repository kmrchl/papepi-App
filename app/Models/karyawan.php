<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $fillable = ['nama', 'notelp', 'email', 'alamat', 'posisi', 'jenis_kelamin', 'fingerprint', 'gambar_profil',];


    public function absensi()
    {
        return $this->hasMany(absensi::class, 'id_karyawan');
    }

    public function gaji()
    {
        return $this->hasMany(gaji::class, 'id_karyawan');
    }
}
