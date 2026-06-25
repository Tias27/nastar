<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'comment'    => 'The session id',
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
                'comment'    => 'The user IP address',
            ],
            'timestamp' => [
                'type'       => 'BIGINT',
                'unsigned'   => true,
                'default'    => 0,
                'comment'    => 'The session creation timestamp',
            ],
            'data' => [
                'type'    => 'LONGTEXT',
                'comment' => 'The session data',
            ],
        ]);
        $this->forge->addKey('id', false, true);
        $this->forge->addKey('timestamp');
        $this->forge->createTable('ci_sessions', true);
    }

    public function down()
    {
        $this->forge->dropTable('ci_sessions', true);
    }
}
