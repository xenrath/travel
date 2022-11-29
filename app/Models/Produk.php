<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobil_id',
        'kategori',
        'area',
        'sewa',
        'status'
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
    
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
