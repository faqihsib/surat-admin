<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permohonan_surat', function (Blueprint $table) {
            $table->id('permohonan_id'); // Primary Key (PK)
            $table->string('nomor_permohonan')->unique(); // Unique (UNQ)

            // Foreign Key (FK) ke tabel 'warga'
            $table->unsignedBigInteger('pemohon_warga_id');
            $table->foreign('pemohon_warga_id')->references('warga_id')->on('warga')->onDelete('cascade');

            // Foreign Key (FK) ke tabel 'jenis_surat'
            $table->unsignedBigInteger('jenis_id');
            $table->foreign('jenis_id')->references('jenis_id')->on('jenis_surat')->onDelete('cascade');

            $table->date('tanggal_pengajuan');
            $table->string('status');
            $table->text('catatan')->nullable(); // Dibuat nullable karena opsional

            $table->timestamps(); // Ini akan membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_surat');
    }
};
