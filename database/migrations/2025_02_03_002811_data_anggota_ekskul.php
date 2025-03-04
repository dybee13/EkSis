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
        Schema::create('data_anggota_ekskul', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ekskul')->constrained('ekskuls')->onDelete('cascade');
            $table->string('name');
            $table->string('nis')->nullable()->unique();
            $table->string('jurusan')->nullable();
            $table->string('no_hp')->unique();
            $table->string('email')->unique();
            $table->string('pp')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
