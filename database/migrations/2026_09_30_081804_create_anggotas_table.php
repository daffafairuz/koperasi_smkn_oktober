<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->string('no_anggota')->primary();

            // Relasi ke tabel users
            $table->string('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');

            $table->string('nama');
            $table->string('no_hp');
            $table->bigInteger('saldo_akhir')->default(0);
            $table->bigInteger('total_tagihan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
