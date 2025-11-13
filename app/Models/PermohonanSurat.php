<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'permohonan_surat';

    // Primary key
    protected $primaryKey = 'permohonan_id';

    // Kolom yang bisa diisi (sesuai skema Anda)
    protected $fillable = [
        'nomor_permohonan',
        'pemohon_warga_id',
        'jenis_id',
        'tanggal_pengajuan',
        'status',
        'catatan',
    ];

    /**
     * Relasi ke Warga (Pemohon).
     * Satu permohonan dimiliki oleh satu warga.
     */
    public function pemohon()
    {
        // 'pemohon_warga_id' adalah foreign key di tabel permohonan_surat
        // 'warga_id' adalah primary key di tabel warga
        return $this->belongsTo(Warga::class, 'pemohon_warga_id', 'warga_id');
    }

    /**
     * Relasi ke JenisSurat.
     * Satu permohonan memiliki satu jenis surat.
     */
    public function jenisSurat()
    {
        // 'jenis_id' adalah foreign key di tabel permohonan_surat
        // 'jenis_id' adalah primary key di tabel jenis_surat
        return $this->belongsTo(JenisSurat::class, 'jenis_id', 'jenis_id');
    }

    // Catatan: Relasi ke berkas dan riwayat bisa ditambahkan di sini juga
    // public function berkasPersyaratan()
    // {
    //     return $this->hasMany(BerkasPersyaratan::class, 'permohonan_id', 'permohonan_id');
    // }
}
