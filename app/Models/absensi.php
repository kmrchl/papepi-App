<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class absensi extends Authenticatable
{
    use HasFactory;

    protected $table = 'absensi';
    protected $primarykey = 'id_absen';
    protected $fillable = ['id_karyawan', 'jam_masuk', 'jam_kerja', 'jam_keluar'];

    public function karyawan()
    {
        return $this->belongsTo(karyawan::class, 'id_karyawan');
    }
}
