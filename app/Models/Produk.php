<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tahun',
        'plat',
        'warna',
        'kapasitas',
        'fasilitas',
        'gambar',
        'sewa',
        'status'
    ];
}
