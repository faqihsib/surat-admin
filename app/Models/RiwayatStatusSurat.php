<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatStatusSurat extends Model
{
    protected $table = 'riwayat_status_surat';
    protected $primaryKey = 'riwayat_id';
    protected $guarded = [];

    public function permohonan()
    {
        return $this->belongsTo(PermohonanSurat::class, 'permohonan_id', 'permohonan_id');
    }

    public function petugas()
    {
        return $this->belongsTo(Warga::class, 'petugas_warga_id', 'warga_id');
    }
}
