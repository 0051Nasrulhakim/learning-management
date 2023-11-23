<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiswaList extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        //data send
        for($jumlah = 0; $jumlah < 20; $jumlah++){
            
            $jenis_kelamin = $faker->randomElement(['L', 'P']);
            $kelas = $faker->randomElement(['12','11','10']);
            $jurusan = $faker->randomElement(['1','2']);

            if ($jenis_kelamin == "L") {
                $gender = "male";
                $jenis_kelamin = $jenis_kelamin;
            } else {
                $gender = "female";
                $jenis_kelamin = $jenis_kelamin;
            }

            if($jumlah < 10){
                $nis = "1920".$jumlah;

                $data = [
                    // 'id' => 'darth',
                    'nis'           => $nis,
                    'nama_siswa'    => $faker->name($gender),
                    'id_kelas'      => $kelas.$jurusan.'1',
                    'jenis_kelamin' => $jenis_kelamin,
                    'id_tahun'      => '1',
                    'nama_ayah'     => $faker->name('male'),
                    'nama_ibu'      => $faker->name('female'),
                    'alamat'        => $faker->address,
                    'status'        => 'Aktiv',
                ];

                $this->db->table('siswa')->insert($data);

            }elseif($jumlah >= 10){
                $nis = "192".$jumlah;

                $data = [
                    // 'id' => 'darth',
                    'nis'           => $nis,
                    'nama_siswa'    => $faker->name($gender),
                    'id_kelas'      => $kelas.$jurusan.'1',
                    'jenis_kelamin' => $jenis_kelamin,
                    'id_tahun'      => '1',
                    'nama_ayah'     => $faker->name('male'),
                    'nama_ibu'      => $faker->name('female'),
                    'alamat'        => $faker->address,
                    'status'        => 'Aktiv',
                ];

                $this->db->table('siswa')->insert($data);
            }
        }
    }
}
