<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nik',
        'nama',
        'telp',
        'alamat',
        'gender',
        'password',
        'latitude',
        'longitude',
        'alamat',
        'foto',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function isAdmin()
    {
        if ($this->role == 'admin') {
            return true;
        }
        return false;
    }

    public function isOwner()
    {
        if ($this->role == 'owner') {
            return true;
        }
        return false;
    }
}