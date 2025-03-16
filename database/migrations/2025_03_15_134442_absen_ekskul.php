<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absen_ekskul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_anggota')->constrained('data_anggota_ekskul')->onDelete('cascade');
            $table->foreignId('id_ekskul')->constrained('ekskuls')->onDelete('cascade');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpha']);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absen_ekskul');
    }
};
