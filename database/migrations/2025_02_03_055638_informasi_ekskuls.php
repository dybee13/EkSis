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
            $table->date('tgl_berdiri')->nullable();
            $table->text('logo')->default(null)->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('kategori', ['seni', 'olahraga', 'religi', 'akademik', 'kepemimpinan']);
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
