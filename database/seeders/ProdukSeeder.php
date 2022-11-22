<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produks = [
            [
                'nama' => 'Toyota Avanza',
                'tahun' => '2018',
                'plat' => 'G1234IJ',
                'warna' => 'Hitam',
                'kapasitas' => '4',
                'fasilitas' => 'AC, Media Player',
                'gambar' => 'produk/toyotaavanza2018hitam.jpg',
                'sewa' => '350000',
                'status' => true
            ],
            [
                'nama' => 'Honda Mobilio',
                'tahun' => '2019',
                'plat' => 'G2345JK',
                'warna' => 'Silver',
                'kapasitas' => '4',
                'fasilitas' => 'AC, Media Player',
                'gambar' => 'produk/hondamobilio2019silver.jpg',
                'sewa' => '350000',
                'status' => true
            ],
            [
                'nama' => 'Toyota Grand Innova',
                'tahun' => '2020',
                'plat' => 'G3456KL',
                'warna' => 'Putih',
                'kapasitas' => '4',
                'fasilitas' => 'AC, Media Player',
                'gambar' => 'produk/toyotagrandinnova2020putih.jpg',
                'sewa' => '400000',
                'status' => true
            ],
            [
                'nama' => 'Mitsubishi Xpander',
                'tahun' => '2021',
                'plat' => 'G4567LM',
                'warna' => 'Silver',
                'kapasitas' => '6',
                'fasilitas' => 'AC',
                'gambar' => 'produk/mitsubishixpander2021silver.jpg',
                'sewa' => '450000',
                'status' => true
            ],
        ];

        Produk::insert($produks);
    }
}
