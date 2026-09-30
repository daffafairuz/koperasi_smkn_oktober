<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bussiness_need', function (Blueprint $table) {
            $table->string('id_bn')->primary();
            $table->string('periode')->unique();
            $table->bigInteger('simpanan_pokok');
            $table->bigInteger('simpanan_wajib');
            $table->integer('persen_bunga_barang');
            $table->boolean('status_aktif')->default(true);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bussiness_need');
    }
};
