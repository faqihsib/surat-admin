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
        Schema::create('riwayat_status_surat', function (Blueprint $table) {
            $table->id('riwayat_id'); // PK
            $table->foreignId('permohonan_id'); // FK
            $table->string('status');
            $table->unsignedBigInteger('petugas_warga_id'); // FK ke Warga
            $table->dateTime('waktu')->useCurrent();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_status_surat');
    }
};
