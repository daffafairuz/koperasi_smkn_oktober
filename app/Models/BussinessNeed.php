<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BussinessNeed extends Model
{
    use HasFactory;

    protected $table = 'bussiness_need';
    protected $primaryKey = 'id_bn';
    public $incrementing = false;
    protected $keyType = 'string';

    // Karena di migration hanya menggunakan created_at
    public $timestamps = false;
    protected $dates = ['created_at'];

    protected $fillable = [
        'id_bn',
        'periode',
        'simpanan_pokok',
        'simpanan_wajib',
        'persen_bunga_barang',
        'status_aktif',
        'created_at',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];
}
