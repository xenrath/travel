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
                'nama' => 'Avanza Grand New',
                'tahun' => '2018',
                'plat' => 'G 1234I J',
                'warna' => 'Hitam',
                'kapasitas' => '4',
                'fasilitas' => 'AC, Media Player',
                'gambar' => 'mobil/avanzagrandnew.png',
                'status' => true
            ],
            [
                'nama' => 'Avanza Facelift',
                'tahun' => '2019',
                'plat' => 'G 2345 JK',
                'warna' => 'Silver',
                'kapasitas' => '4',
                'fasilitas' => 'AC, Media Player',
                'gambar' => 'mobil/avanzafacelift.jpg',
                'status' => true
            ],
            [
                'nama' => 'Xenia Grand New',
                'tahun' => '2016',
                'plat' => 'G 3456 KL',
                'warna' => 'Putih',
                'kapasitas' => '4',
                'fasilitas' => 'AC, Media Player',
                'gambar' => 'mobil/xeniagrandnew.png',
                'status' => true
            ],
            [
                'nama' => 'Xenia Facelift',
                'tahun' => '2021',
                'plat' => 'G 4567 LM',
                'warna' => 'Silver',
                'kapasitas' => '6',
                'fasilitas' => 'AC',
                'gambar' => 'mobil/xeniafacelift.jpg',
                'status' => true
            ],
            [
                'nama' => 'Mobilio',
                'tahun' => '2021',
                'plat' => 'M 4567 LM',
                'warna' => 'Silver',
                'kapasitas' => '6',
                'fasilitas' => 'AC',
                'gambar' => 'mobil/mobilio.png',
                'status' => true
            ],
            [
                'nama' => 'Brio Facelift',
                'tahun' => '2021',
                'plat' => 'B 4567 LM',
                'warna' => 'Silver',
                'kapasitas' => '6',
                'fasilitas' => 'AC',
                'gambar' => 'mobil/briofacelift.jpg',
                'status' => true
            ],
            [
                'nama' => 'Luxio',
                'tahun' => '2021',
                'plat' => 'B 1093 KRX',
                'warna' => 'Silver',
                'kapasitas' => '6',
                'fasilitas' => 'AC',
                'gambar' => 'mobil/luxio.jpg',
                'status' => true
            ],
            [
                'nama' => 'Grand Max',
                'tahun' => '2021',
                'plat' => 'G 1122 LM',
                'warna' => 'Silver',
                'kapasitas' => '6',
                'fasilitas' => 'AC',
                'gambar' => 'mobil/grandmax.jpeg',
                'status' => true
            ],
            [
                'nama' => 'Toyota Hiace',
                'tahun' => '2021',
                'plat' => 'H 7053 AG',
                'warna' => 'Silver',
                'kapasitas' => '6',
                'fasilitas' => 'AC',
                'gambar' => 'mobil/toyotahiace.png',
                'status' => true
            ],
            [
                'nama' => 'Elf Long Sasis 18 Seat',
                'tahun' => '2021',
                'plat' => 'Z 7558 AA',
                'warna' => 'Silver',
                'kapasitas' => '6',
                'fasilitas' => 'AC',
                'gambar' => 'mobil/elflongseat.jpg',
                'status' => true
            ],
            [
                'nama' => 'Sigra',
                'tahun' => '2018',
                'plat' => 'G 9999 RA',
                'warna' => 'Silver',
                'kapasitas' => '6',
                'fasilitas' => 'AC',
                'gambar' => 'mobil/sigra.jpg',
                'status' => true
            ],
            [
                'nama' => 'Ertiga',
                'tahun' => '2018',
                'plat' => 'ER 3333 RA',
                'warna' => 'Silver',
                'kapasitas' => '6',
                'fasilitas' => 'AC',
                'gambar' => 'mobil/ertiga.png',
                'status' => true
            ],

            
            // [
            //     'nama' => 'Toyota Avanza',
            //     'tahun' => '2018',
            //     'plat' => 'G1234IJ',
            //     'warna' => 'Hitam',
            //     'kapasitas' => '4',
            //     'fasilitas' => 'AC, Media Player',
            //     'gambar' => 'mobil/toyotaavanza2018hitam.jpg',
            //     'status' => true
            // ],
            // [
            //     'nama' => 'Honda Mobilio',
            //     'tahun' => '2019',
            //     'plat' => 'G2345JK',
            //     'warna' => 'Silver',
            //     'kapasitas' => '4',
            //     'fasilitas' => 'AC, Media Player',
            //     'gambar' => 'mobil/hondamobilio2019silver.jpg',
            //     'status' => true
            // ],
            // [
            //     'nama' => 'Toyota Grand Innova',
            //     'tahun' => '2020',
            //     'plat' => 'G3456KL',
            //     'warna' => 'Putih',
            //     'kapasitas' => '4',
            //     'fasilitas' => 'AC, Media Player',
            //     'gambar' => 'mobil/toyotagrandinnova2020putih.jpg',
            //     'status' => true
            // ],
            // [
            //     'nama' => 'Mitsubishi Xpander',
            //     'tahun' => '2021',
            //     'plat' => 'G4567LM',
            //     'warna' => 'Silver',
            //     'kapasitas' => '6',
            //     'fasilitas' => 'AC',
            //     'gambar' => 'mobil/mitsubishixpander2021silver.jpg',
            //     'status' => true
            // ]
        ];

        Mobil::insert($mobils);
    }
}
