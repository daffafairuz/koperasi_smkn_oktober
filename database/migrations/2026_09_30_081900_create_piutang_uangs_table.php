<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('piutang_uang', function (Blueprint $table) {
            $table->string('id_piutang_uang')->primary();

            // Relasi ke tabel anggota
            $table->string('no_anggota');
            $table->foreign('no_anggota')->references('no_anggota')->on('anggota')->onDelete('cascade');

            $table->bigInteger('total_piutang_awal');
            $table->bigInteger('sisa_piutang_uang');
            $table->bigInteger('angsuran_uang');
            $table->integer('tenor_uang');
            $table->integer('sisa_tenor_uang');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('piutang_uang');
    }
};
