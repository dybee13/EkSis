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
            $table->foreignId('id_ekskul')->constrained('ekskuls')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->enum('keterangan', ['ketua_ekskul', 'waketu_ekskul', 'bendahara', 'sekretaris', 'anggota']);
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
