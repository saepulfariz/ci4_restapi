<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'npm' => [
                'type'       => 'VARCHAR',
                'constraint' => '9',
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'jurusan' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa');
    }
}
