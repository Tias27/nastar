<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CleanupDb extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'db:cleanup';
    protected $description = 'Cleans up the database according to final constraints.';

    public function run(array $params)
    {
        $db = \Config\Database::connect();
        $forge = \Config\Database::forge();

        // 1. Drop unused tables
        if ($db->tableExists('categories')) {
            $forge->dropTable('categories', true);
            CLI::write('Dropped table categories', 'green');
        }
        if ($db->tableExists('testimonials')) {
            $forge->dropTable('testimonials', true);
            CLI::write('Dropped table testimonials', 'green');
        }

        // 2. Modify products table
        if ($db->tableExists('products')) {
            $fields = $db->getFieldNames('products');
            
            if (in_array('id_category', $fields)) {
                try {
                    $forge->dropForeignKey('products', 'products_ibfk_1');
                    CLI::write('Dropped foreign key products_ibfk_1', 'yellow');
                } catch (\Exception $e) {
                    CLI::write('Could not drop foreign key: ' . $e->getMessage(), 'red');
                }
                
                $forge->dropColumn('products', 'id_category');
                CLI::write('Dropped column id_category from products', 'green');
            }
            
            $toDrop = ['slug', 'is_featured', 'is_active', 'berat'];
            foreach ($toDrop as $col) {
                if (in_array($col, $fields)) {
                    $forge->dropColumn('products', $col);
                    CLI::write("Dropped column $col from products", 'green');
                }
            }
        }

        CLI::write("Database cleanup completed.", 'green');
    }
}
