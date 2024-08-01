<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyek_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('proyek')->onDelete('cascade');
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');
            $table->string('file_path')->nullable();
            $table->string('file_link')->nullable();
            $table->boolean('status')->default(false); // false: belum mengerjakan, true: sudah mengerjakan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyek_siswa');
    }
};
