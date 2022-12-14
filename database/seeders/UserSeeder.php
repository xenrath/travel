<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $num = '12345678901234567890';
        $users = [
            [
                'nik' => $this->generatorNik($num),
                'nama' => 'Admin',
                'telp' => 'admin',
                'alamat' => '',
                'latitude' => '',
                'longitude' => '',
                'gender' => 'L',
                'password' => bcrypt('admin'),
                'foto' => '',
                'role' => 'admin'
            ],
            [
                'nik' => $this->generatorNik($num),
                'nama' => 'Sopir1',
                'telp' => $this->generatorTelp($num),
                'alamat' => 'Tegal',
                'latitude' => '',
                'longitude' => '',
                'gender' => 'L',
                'password' => bcrypt('sopir1'),
                'foto' => '',
                'role' => 'sopir'
            ],
            [
                'nik' => $this->generatorNik($num),
                'nama' => 'Sopir2',
                'telp' => $this->generatorTelp($num),
                'alamat' => 'Slawi',
                'latitude' => '',
                'longitude' => '',
                'gender' => 'L',
                'password' => bcrypt('sopir1'),
                'foto' => '',
                'role' => 'sopir'
            ],
            [
                'nik' => $this->generatorNik($num),
                'nama' => 'pelanggan1',
                // 'telp' => $this->generatorTelp($num),
                'telp' => 'pelanggan1',
                'alamat' => 'Brebes',
                'latitude' => '-6.898275551098579',
                'longitude' => '109.11876260154958',
                'gender' => 'L',
                'password' => bcrypt('pelanggan1'),
                'foto' => 'user/pelanggan1.jpg',
                'role' => 'pelanggan'
            ],
            [
                'nik' => $this->generatorNik($num),
                'nama' => 'pelanggan2',
                // 'telp' => $this->generatorTelp($num),
                'telp' => 'pelanggan2',
                'alamat' => 'Slawi',
                'latitude' => '-6.897295642504672',
                'longitude' => '109.13335381853707',
                'gender' => 'P',
                'password' => bcrypt('pelanggan2'),
                'foto' => 'user/pelanggan2.jpg',
                'role' => 'pelanggan'
            ],
        ];

        User::insert($users);
    }

    public function generatorNik($num)
    {
        $nik  = substr(str_shuffle($num), 0, 16);
        return $nik;
    }

    public function generatorTelp($num)
    {
        $telp  = substr(str_shuffle($num), 0, 11);
        return "8" . $telp;
    }
}
