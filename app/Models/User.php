<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_user',
        'username',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relasi ke Anggota (User memilik satu profil Anggota jika role = ANGGOTA)
     */
    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'id_user', 'id_user');
    }

    /**
     * Relasi ke KasKoperasi (User/Admin mencatat banyak mutasi kas)
     */
    public function kasKoperasi()
    {
        return $this->hasMany(KasKoperasi::class, 'id_user', 'id_user');
    }
}
