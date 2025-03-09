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
        Schema::create('struktur_ekskuls', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('id_anggota_ekskul')->constrained('data_anggota_ekskul')->onDelete('cascade');
            $table->foreignId('id_ekskul')->constrained('ekskuls')->onDelete('cascade');
            $table->string('ketua_ekskul', 50)->nullable();
            $table->string('waketu_ekskul', 50)->nullable();
            $table->string('bendahara', 50)->nullable();
            // $table->enum('keterangan', ['ketua_ekskul', 'waketu_ekskul', 'bendahara', 'sekretaris', 'anggota']);
            $table->timestamps();
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
