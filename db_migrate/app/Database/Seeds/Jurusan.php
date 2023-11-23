<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Jurusan extends Seeder
{
    public function run()
    {
        //
        $data = [
            [
                'id_jurusan' => '1',
                'singkatan'  => 'TKJ'
                'jurusan'    => 'Teknik Komputer Dan Jaringan'
            ],
            [
                'id_jurusan' => '2',
                'singkatan'  => 'TKR'
                'jurusan'    => 'Teknik Kendaraan Ringan'
            ]
        ];

        $this->db->table('jurusan')->insertBatch($data);
    }
}
