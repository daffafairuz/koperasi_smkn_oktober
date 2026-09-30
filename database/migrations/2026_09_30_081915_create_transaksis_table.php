<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('no_transaksi')->primary();

            // Relasi Opsional (Nullable)
            $table->string('no_anggota')->nullable();
            $table->foreign('no_anggota')->references('no_anggota')->on('anggota')->onDelete('set null');

            $table->string('id_piutang_uang')->nullable();
            $table->foreign('id_piutang_uang')->references('id_piutang_uang')->on('piutang_uang')->onDelete('set null');

            $table->string('id_pinjaman_barang')->nullable();
            $table->foreign('id_pinjaman_barang')->references('id_pinjaman_barang')->on('pinjaman_barang')->onDelete('set null');

            $table->enum('jenis_transaksi', [
                'SETOR_SIMPANAN_POKOK',
                'SETOR_SIMPANAN_WAJIB',
                'PENCAIRAN_PIUTANG_UANG',
                'PENCAIRAN_PINJAMAN_BARANG',
                'BAYAR_ANGSURAN_UANG',
                'BAYAR_ANGSURAN_BARANG',
                'PEMASUKAN_OPERASIONAL',
                'PENGELUARAN_OPERASIONAL',
                'PEMBELIAN_STOK_BARANG'
            ]);
            $table->bigInteger('nominal');
            $table->text('keterangan')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
