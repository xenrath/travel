<?php

namespace Database\Seeders;

use App\Models\Mobil;
use Illuminate\Database\Seeder;

class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mobils = [
            [
                'nama' => 'Toyota Avanza',
                'tahun' => '2018',
                'plat' => 'G1234IJ',
                'warna' => 'Hitam',
                'kapasitas' => '4',
                'fasilitas' => 'AC, Media Player',
                'gambar' => '',
                'status' => true
            ],
            [
                'nama' => 'Honda Mobilio',
                'tahun' => '2019',
                'plat' => 'G2345JK',
                'warna' => 'Silver',
                'kapasitas' => '4',
                'fasilitas' => 'AC, Media Player',
                'gambar' => '',
                'status' => true
            ],
            [
                'nama' => 'Toyota Grand Innova',
                'tahun' => '2020',
                'plat' => 'G3456KL',
                'warna' => 'Putih',
                'kapasitas' => '4',
                'fasilitas' => 'AC, Media Player',
                'gambar' => '',
                'status' => true
            ],
            [
                'nama' => 'Mitsubishi Xpander',
                'tahun' => '2021',
                'plat' => 'G4567LM',
                'warna' => 'Silver',
                'kapasitas' => '6',
                'fasilitas' => 'AC',
                'gambar' => '',
                'status' => true
            ],
        ];

        Mobil::insert($mobils);
    }
}
