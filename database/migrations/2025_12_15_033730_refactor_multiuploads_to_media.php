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
        if (Schema::hasTable('multiuploads')) {
        Schema::rename('multiuploads', 'media');
    }

        Schema::table('media', function (Blueprint $table) {
            $table->renameColumn('id', 'media_id');
            $table->renameColumn('filename', 'file_url');

            // Tambah kolom baru
            $table->string('caption')->nullable()->after('ref_id');
            $table->string('mime_type')->nullable()->after('caption');
            $table->integer('sort_order')->default(0)->after('mime_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('media')) {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn(['caption', 'mime_type', 'sort_order']);
            $table->renameColumn('file_url', 'filename');
            $table->renameColumn('media_id', 'id');
        });
        Schema::rename('media', 'multiuploads');
    }
    }
};
