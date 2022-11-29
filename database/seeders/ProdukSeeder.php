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
            // [
            //     'nama' => 'Avanza Grand New',
            //     'tahun' => '2018',
            //     'plat' => 'G1234IJ',
            //     'warna' => 'Hitam',
            //     'kapasitas' => '4',
            //     'fasilitas' => 'AC, Media Player',
            //     'kategori' => 'rental',
            //     'area' => '',
            //     'gambar' => 'produk/toyotaavanza2018hitam.jpg',
            //     'sewa' => '300000',
            //     'status' => true
            // ],
            // [
            //     'nama' => 'Avanza Facelift',
            //     'tahun' => '2019',
            //     'plat' => 'G2345JK',
            //     'warna' => 'Silver',
            //     'kapasitas' => '4',
            //     'fasilitas' => 'AC, Media Player',
            //     'kategori' => 'rental',
            //     'area' => '',
            //     'gambar' => 'produk/hondamobilio2019silver.jpg',
            //     'sewa' => '350000',
            //     'status' => true
            // ],
            // [
            //     'nama' => 'Xenia Grand New',
            //     'tahun' => '2016',
            //     'plat' => 'G3456KL',
            //     'warna' => 'Putih',
            //     'kapasitas' => '4',
            //     'fasilitas' => 'AC, Media Player',
            //     'kategori' => 'rental',
            //     'area' => '',
            //     'gambar' => 'produk/toyotagrandinnova2020putih.jpg',
            //     'sewa' => '300000',
            //     'status' => true
            // ],
            // [
            //     'nama' => 'Xenia Facelift',
            //     'tahun' => '2021',
            //     'plat' => 'G4567LM',
            //     'warna' => 'Silver',
            //     'kapasitas' => '6',
            //     'fasilitas' => 'AC',
            //     'kategori' => 'rental',
            //     'area' => '',
            //     'gambar' => 'produk/mitsubishixpander2021silver.jpg',
            //     'sewa' => '350000',
            //     'status' => true
            // ],
            // [
            //     'nama' => 'Mobilio',
            //     'tahun' => '2021',
            //     'plat' => 'G4567LM',
            //     'warna' => 'Silver',
            //     'kapasitas' => '6',
            //     'fasilitas' => 'AC',
            //     'kategori' => 'rental',
            //     'area' => '',
            //     'gambar' => 'produk/mitsubishixpander2021silver.jpg',
            //     'sewa' => '350000',
            //     'status' => true
            // ],
            // [
            //     'nama' => 'Brio Facelift',
            //     'tahun' => '2021',
            //     'plat' => 'G4567LM',
            //     'warna' => 'Silver',
            //     'kapasitas' => '6',
            //     'fasilitas' => 'AC',
            //     'kategori' => 'rental',
            //     'area' => '',
            //     'gambar' => 'produk/mitsubishixpander2021silver.jpg',
            //     'sewa' => '350000',
            //     'status' => true
            // ],
            // [
            //     'nama' => 'Luxio',
            //     'tahun' => '2021',
            //     'plat' => 'G4567LM',
            //     'warna' => 'Silver',
            //     'kapasitas' => '6',
            //     'fasilitas' => 'AC',
            //     'kategori' => 'rental',
            //     'area' => '',
            //     'gambar' => 'produk/mitsubishixpander2021silver.jpg',
            //     'sewa' => '350000',
            //     'status' => true
            // ],
            // [
            //     'nama' => 'Grand Max',
            //     'tahun' => '2021',
            //     'plat' => 'G4567LM',
            //     'warna' => 'Silver',
            //     'kapasitas' => '6',
            //     'fasilitas' => 'AC',
            //     'kategori' => 'rental',
            //     'area' => '',
            //     'gambar' => 'produk/mitsubishixpander2021silver.jpg',
            //     'sewa' => '350000',
            //     'status' => true
            // ],
            // [
            //     'nama' => 'Toyota Hiace',
            //     'tahun' => '2021',
            //     'plat' => 'G4567LM',
            //     'warna' => 'Silver',
            //     'kapasitas' => '6',
            //     'fasilitas' => 'AC',
            //     'kategori' => 'rental',
            //     'area' => '',
            //     'gambar' => 'produk/mitsubishixpander2021silver.jpg',
            //     'sewa' => '350000',
            //     'status' => true
            // ],

            [
                'mobil_id' => '1',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '350000',
            ],
            [
                'mobil_id' => '2',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '350000',
            ],
            [
                'mobil_id' => '3',
                'kategori' => 'tour',
                'area' => 'dalam',
                'sewa' => '400000',
            ],
            [
                'mobil_id' => '4',
                'kategori' => 'tour',
                'area' => 'luar',
                'sewa' => '450000',
            ],
        ];

        Produk::insert($produks);
    }
}
