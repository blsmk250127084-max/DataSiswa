<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPageToSiswa extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('siswa', [
            'page' => [
                'type'       => 'INT',
                'constraint' => 1,
                'unsigned'   => true,
                'default'    => 1,
            ],
        ]);
    }

    public function down(): void
    {
        $this->forge->dropColumn('siswa', 'page');
    }
}
