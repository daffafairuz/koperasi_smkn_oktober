<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kas_koperasi', function (Blueprint $table) {
            $table->string('id_kas')->primary();

            // Relasi Opsional ke Transaksi
            $table->string('no_transaksi')->nullable();
            $table->foreign('no_transaksi')->references('no_transaksi')->on('transaksi')->onDelete('set null');

            // Relasi ke User (Pencatat Mutasi)
            $table->string('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');

            $table->enum('jenis_mutasi', ['MASUK', 'KELUAR']);
            $table->bigInteger('nominal');
            $table->bigInteger('saldo_setelah_mutasi');
            $table->text('keterangan')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kas_koperasi');
    }
};
