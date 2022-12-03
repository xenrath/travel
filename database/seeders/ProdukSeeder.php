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
                'mobil_id' => '1',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '300000',
            ],
            [
                'mobil_id' => '2',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '350000',
            ],
            [
                'mobil_id' => '3',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '300000',
            ],
            [
                'mobil_id' => '4',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '350000',
            ],
            [
                'mobil_id' => '5',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '350000',
            ],
            [
                'mobil_id' => '6',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '350000',
            ],
            [
                'mobil_id' => '7',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '350000',
            ],
            [
                'mobil_id' => '8',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '350000',
            ],
            [
                'mobil_id' => '9',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '1100000',
            ],
            [
                'mobil_id' => '9',
                'kategori' => 'tour',
                'area' => 'dalam',
                'sewa' => '1350000',
            ],
            [
                'mobil_id' => '9',
                'kategori' => 'tour',
                'area' => 'luar',
                'sewa' => '1450000',
            ],
            [
                'mobil_id' => '10',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '1300000',
            ],
            [
                'mobil_id' => '10',
                'kategori' => 'tour',
                'area' => 'dalam',
                'sewa' => '1550000',
            ],
            [
                'mobil_id' => '10',
                'kategori' => 'tour',
                'area' => 'luar',
                'sewa' => '1650000',
            ],
            [
                'mobil_id' => '11',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '300000',
            ],
            [
                'mobil_id' => '12',
                'kategori' => 'rental',
                'area' => null,
                'sewa' => '300000',
            ],
        ];

        Produk::insert($produks);
    }
}
