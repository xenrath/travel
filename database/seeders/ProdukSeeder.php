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
                'sewa' => '350000',
                'denda' => '350000'
            ],
            [
                'mobil_id' => '2',
                'sewa' => '350000',
                'denda' => '350000'
            ],
            [
                'mobil_id' => '3',
                'sewa' => '400000',
                'denda' => '400000'
            ],
            [
                'mobil_id' => '4',
                'sewa' => '450000',
                'denda' => '450000'
            ],
        ];

        Produk::insert($produks);
    }
}
