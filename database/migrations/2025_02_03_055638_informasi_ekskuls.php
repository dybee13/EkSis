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
        Schema::create('informasi_ekskuls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ekskul')->constrained('ekskuls')->onDelete('cascade');
            $table->foreignId('id_struktur')->constrained('struktur_ekskuls')->onDelete('cascade');
            $table->date('tgl_berdiri')->nullable();
            $table->text('logo')->default(null)->nullable();
            $table->string('jadwal')->nullable();
            $table->text('deskripsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
