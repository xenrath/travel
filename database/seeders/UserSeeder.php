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
                'nama' => 'Owner',
                'telp' => 'owner',
                'alamat' => '',
                'latitude' => '',
                'longitude' => '',
                'gender' => 'L',
                'password' => bcrypt('owner'),
                'foto' => '',
                'role' => 'owner'
            ],
            [
                'nik' => $this->generatorNik($num),
                'nama' => 'Ahmad',
                'telp' => $this->generatorTelp($num),
                'alamat' => 'Tegal',
                'latitude' => '',
                'longitude' => '',
                'gender' => 'L',
                'password' => bcrypt('ahmad'),
                'foto' => '',
                'role' => 'sopir'
            ],
            [
                'nik' => $this->generatorNik($num),
                'nama' => 'Abdul',
                'telp' => $this->generatorTelp($num),
                'alamat' => 'Slawi',
                'latitude' => '',
                'longitude' => '',
                'gender' => 'L',
                'password' => bcrypt('abdul'),
                'foto' => '',
                'role' => 'sopir'
            ],
            [
                'nik' => $this->generatorNik($num),
                'nama' => 'Messi',
                // 'telp' => $this->generatorTelp($num),
                'telp' => '81234567890',
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
                'nama' => 'Freya',
                // 'telp' => $this->generatorTelp($num),
                'telp' => '82345678901',
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
