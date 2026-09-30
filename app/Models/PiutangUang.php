<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiutangUang extends Model
{
    use HasFactory;

    protected $table = 'piutang_uang';
    protected $primaryKey = 'id_piutang_uang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_piutang_uang',
        'no_anggota',
        'total_piutang_awal',
        'sisa_piutang_uang',
        'angsuran_uang',
        'tenor_uang',
        'sisa_tenor_uang',
    ];

    /**
     * Relasi ke Anggota (Piutang uang dimiliki oleh Anggota)
     */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'no_anggota', 'no_anggota');
    }

    /**
     * Relasi ke Transaksi (Piutang uang dicatat dalam banyak transaksi angsuran/pencairan)
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_piutang_uang', 'id_piutang_uang');
    }
}
