<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasPersyaratan extends Model
{
    protected $table = 'berkas_persyaratan';
    protected $primaryKey = 'berkas_id';
    protected $guarded = [];

    public function permohonan()
    {
        return $this->belongsTo(PermohonanSurat::class, 'permohonan_id', 'permohonan_id');
    }

    // Relasi ke Media
    public function media()
    {
        return $this->hasOne(Media::class, 'ref_id', 'berkas_id')->where('ref_table', 'berkas_persyaratan');
    }
}
