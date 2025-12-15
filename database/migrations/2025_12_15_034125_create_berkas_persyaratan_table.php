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
        Schema::create('berkas_persyaratan', function (Blueprint $table) {
            $table->id('berkas_id'); // PK
            $table->foreignId('permohonan_id'); // FK
            $table->string('nama_berkas');
            $table->boolean('valid')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_persyaratan');
    }
};
