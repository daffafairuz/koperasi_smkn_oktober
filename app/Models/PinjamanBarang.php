<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamanBarang extends Model
{
    use HasFactory;

    protected $table = 'pinjaman_barang';
    protected $primaryKey = 'id_pinjaman_barang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pinjaman_barang',
        'no_anggota',
        'harga_barang_awal',
        'persen_bunga',
        'nominal_bunga',
        'total_pinjaman_barang',
        'sisa_pinjaman_barang',
        'angsuran_barang',
        'tenor_barang',
        'sisa_tenor_barang',
    ];

    /**
     * Relasi ke Anggota (Pinjaman barang dimiliki oleh Anggota)
     */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'no_anggota', 'no_anggota');
    }

    /**
     * Relasi ke Transaksi (Pinjaman barang dicatat dalam banyak transaksi angsuran/pencairan)
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pinjaman_barang', 'id_pinjaman_barang');
    }
}
