<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pinjaman_barang', function (Blueprint $table) {
            $table->string('id_pinjaman_barang')->primary();

            // Relasi ke tabel anggota
            $table->string('no_anggota');
            $table->foreign('no_anggota')->references('no_anggota')->on('anggota')->onDelete('cascade');

            $table->bigInteger('harga_barang_awal');
            $table->integer('persen_bunga');
            $table->bigInteger('nominal_bunga');
            $table->bigInteger('total_pinjaman_barang');
            $table->bigInteger('sisa_pinjaman_barang');
            $table->bigInteger('angsuran_barang');
            $table->integer('tenor_barang');
            $table->integer('sisa_tenor_barang');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pinjaman_barang');
    }
};
