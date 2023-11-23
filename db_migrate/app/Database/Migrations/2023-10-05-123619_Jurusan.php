<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jurusan extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id_jurusan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'jurusan'   => [
                'type'      => 'text',
            ]
        ]);
        $this->forge->addKey('id_jurusan', true);
        $this->forge->createTable('jurusan');
    }

    public function down()
    {
        //
        $this->forge->dropTable('jurusan');
    }
}
