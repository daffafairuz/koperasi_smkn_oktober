<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';
    protected $primaryKey = 'no_anggota';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'no_anggota',
        'id_user',
        'nama',
        'no_hp',
        'saldo_akhir',
        'total_tagihan',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'saldo_akhir' => 'integer',
        'total_tagihan' => 'integer',
    ];

    /**
     * Relasi ke User (Anggota dimiliki oleh User)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relasi ke PiutangUang (Anggota memiliki banyak data piutang uang)
     */
    public function piutangUang()
    {
        return $this->hasMany(PiutangUang::class, 'no_anggota', 'no_anggota');
    }

    /**
     * Relasi ke PinjamanBarang (Anggota memiliki banyak data pinjaman barang)
     */
    public function pinjamanBarang()
    {
        return $this->hasMany(PinjamanBarang::class, 'no_anggota', 'no_anggota');
    }

    /**
     * Relasi ke Transaksi (Anggota melakukan banyak transaksi)
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'no_anggota', 'no_anggota');
    }
}
