<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proyek_siswa', function (Blueprint $table) {
            $table->text('keterangan')->nullable(); // Menambahkan kolom keterangan
        });
    }

    public function down(): void
    {
        Schema::table('proyek_siswa', function (Blueprint $table) {
            $table->dropColumn('keterangan'); // Menghapus kolom keterangan
        });
    }
};
