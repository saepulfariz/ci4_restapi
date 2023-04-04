<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Limits extends Migration
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
            'controller' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'uri' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'count' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'hour_started' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'api_key' => [
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
        $this->forge->createTable('limits');
    }

    public function down()
    {
        $this->forge->dropTable('limits');
    }
}
