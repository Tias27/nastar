<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CheckDb extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'db:check';
    protected $description = 'Checks the current database schema.';

    public function run(array $params)
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();

        foreach ($tables as $table) {
            CLI::write("Table: $table", 'green');
            $fields = $db->getFieldData($table);
            foreach ($fields as $field) {
                CLI::write("  - $field->name ($field->type)");
            }
            CLI::newLine();
        }
    }
}
