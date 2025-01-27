<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gaji extends Authenticatable
{

    use HasFactory;

    protected $table = 'gaji';
    protected $primaryKey = 'id_gaji';
    protected $fillable = ['id_karyawan', 'gaji', 'tunjangan'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
