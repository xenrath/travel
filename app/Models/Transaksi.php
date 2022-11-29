<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'pelanggan_id',
        'sopir_id',
        'tanggal',
        'lama',
        'harga',
        'metode',
        'bukti',
        'status'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(User::class);
    }

    public function sopir()
    {
        return $this->belongsTo(User::class);
    }
}
