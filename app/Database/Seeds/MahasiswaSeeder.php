<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) { //to add 10 clients. Change limit as desired
            $this->db->table('mahasiswa')->insert($this->generateClient());
        }
    }

    private function generateClient(): array
    {
        $faker = Factory::create();
        return [
            'nama' => $faker->name(),
            'jurusan' => $faker->name(),
            'email' => $faker->email,
            'npm' => random_int(100000000, 100000000)
        ];
    }
}
