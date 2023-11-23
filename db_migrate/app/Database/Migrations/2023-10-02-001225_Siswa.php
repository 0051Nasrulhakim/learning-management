<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
{
    public function down()
    {
        $this->forge->dropTable('siswa');
    }
    
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
            ],
            'nis' => [
                'type'       => 'bigint',
                'constraint' => '12',
            ],
            'nama_siswa' => [
                'type' => 'TEXT',
            ],
            'id_kelas' => [
                'type'       => 'int',
                'constraint' => '5',
            ],
            'jenis_kelamin' => [
                'type'       => 'enum',
                'constraint' => ['L','P'],
            ],
            'id_tahun' => [
                'type'       => 'int',
                'constraint' => '5',
            ],
            'nama_ayah' => [
                'type'       => 'text',
            ],
            'nama_ibu' => [
                'type'       => 'text',
            ],
            'alamat' => [
                'type'       => 'text',
            ],
            'status' => [
                'type'       => 'enum',
                'constraint' => ['Lulus','Aktiv','Cuti','Keluar'],
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('siswa');
    }

}
