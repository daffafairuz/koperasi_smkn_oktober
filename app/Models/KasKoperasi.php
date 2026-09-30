<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasKoperasi extends Model
{
    use HasFactory;

    protected $table = 'kas_koperasi';
    protected $primaryKey = 'id_kas';
    public $incrementing = false;
    protected $keyType = 'string';

    // Karena di migration hanya menggunakan created_at
    public $timestamps = false;
    protected $dates = ['created_at'];

    protected $fillable = [
        'id_kas',
        'no_transaksi',
        'id_user',
        'jenis_mutasi',
        'nominal',
        'saldo_setelah_mutasi',
        'keterangan',
        'created_at',
    ];

    /**
     * Relasi ke Transaksi (Mutasi kas dipengaruhi oleh Transaksi - Opsional)
     */
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'no_transaksi', 'no_transaksi');
    }

    /**
     * Relasi ke User (Mutasi kas dicatat oleh User/Admin)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
