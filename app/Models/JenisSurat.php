<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'jenis_surat';

    // Primary key
    protected $primaryKey = 'jenis_id';

    // Kolom yang bisa diisi
    protected $fillable = [
        'kode',
        'nama_jenis',
        'syarat_json'
    ];

    public function permohonanSurat()
    {
        return $this->hasMany(PermohonanSurat::class, 'jenis_id', 'jenis_id');
    }
}
