<?php

namespace Database\Seeders;

use App\Models\Rekening;
use Illuminate\Database\Seeder;

class RekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rekenings = [
            [
                'bank' => 'BCA',
                'nama' => 'Andhika Yusril Dinul Huda',
                'nomor' => '1330262873',
                'gambar' => 'bank/bri.jpg'
            ],
        ];

        Rekening::insert($rekenings);
    }
}
