<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'no_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';

    // Karena di migration hanya menggunakan created_at
    public $timestamps = false;
    protected $dates = ['created_at'];

    protected $fillable = [
        'no_transaksi',
        'no_anggota',
        'id_piutang_uang',
        'id_pinjaman_barang',
        'jenis_transaksi',
        'nominal',
        'keterangan',
        'created_at',
    ];

    /**
     * Relasi ke Anggota (Transaksi dilakukan oleh Anggota - Opsional)
     */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'no_anggota', 'no_anggota');
    }

    /**
     * Relasi ke PiutangUang (Opsional)
     */
    public function piutangUang()
    {
        return $this->belongsTo(PiutangUang::class, 'id_piutang_uang', 'id_piutang_uang');
    }

    /**
     * Relasi ke PinjamanBarang (Opsional)
     */
    public function pinjamanBarang()
    {
        return $this->belongsTo(PinjamanBarang::class, 'id_pinjaman_barang', 'id_pinjaman_barang');
    }

    /**
     * Relasi ke KasKoperasi (1 Transaksi dapat mempengaruhi 1 Catatan Kas Koperasi)
     */
    public function kasKoperasi()
    {
        return $this->hasOne(KasKoperasi::class, 'no_transaksi', 'no_transaksi');
    }
}
