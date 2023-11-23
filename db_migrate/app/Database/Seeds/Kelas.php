<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kelas extends Seeder
{
    public function run()
    {
        // tkj
        for($kelas_tkj = 10; $kelas_tkj <= 12; $kelas_tkj++){
            for($rombel = 1; $rombel <= 3; $rombel++){
                $data = [
                    'id_kelas' => $kelas_tkj."1".$rombel,
                    'id_jurusan' => 1,
                    'kelas' => $kelas_tkj." TKJ " .$rombel,
                    'keterangan' => $kelas_tkj. ' Teknik Komputer Dan Jaringan '. $rombel
                ];
                $this->db->table('kelas')->insert($data);
            }
        }
        // tkr
        for($kelas_tkr = 10; $kelas_tkr <= 12; $kelas_tkr++){
            for($rombel_tkr = 1; $rombel_tkr <= 3; $rombel_tkr++){
                $data = [
                    'id_kelas' => $kelas_tkr."2".$rombel_tkr,
                    'id_jurusan' => 2,
                    'kelas' => $kelas_tkr." TKR " .$rombel_tkr,
                    'keterangan' => $kelas_tkr. ' Teknik Kendaraan Ringan '. $rombel_tkr
                ];
                $this->db->table('kelas')->insert($data);
            }
        }
    }
}
