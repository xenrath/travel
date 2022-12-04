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
                'bank' => 'BRI',
                'nama' => 'Nur Afif',
                'nomor' => '738234091283902831',
                'gambar' => 'bank/bri.jpg'
            ],
            [
                'bank' => 'BNI',
                'nama' => 'Faris Iman',
                'nomor' => '218973892183',
                'gambar' => 'bank/bni.png'
            ],
            [
                'bank' => 'BCA',
                'nama' => 'Dedi Nugroho',
                'nomor' => '218392891280913',
                'gambar' => 'bank/bca.png'
            ],
        ];

        Rekening::insert($rekenings);
    }
}
