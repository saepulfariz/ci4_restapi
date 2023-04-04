<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Keys extends Migration
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
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'key' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
            ],
            'level' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'ignore_limits' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'is_private_key' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
                'null' => true
            ],
            'created_at' => [
                'type'       => 'DATETIME',
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('keys');
    }

    public function down()
    {
        $this->forge->dropTable('keys');
    }
}
