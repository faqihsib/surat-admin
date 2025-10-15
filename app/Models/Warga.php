<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    // Nama tabel (jika berbeda dari nama model)
    protected $table = 'warga';

    // Primary key
    protected $primaryKey = 'warga_id';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email'
    ];
}
