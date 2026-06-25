<?php
// Scratch script to check current database schema
require 'app/Config/Database.php';
$db = \Config\Database::connect();

$tables = $db->listTables();
foreach ($tables as $table) {
    echo "Table: $table\n";
    $fields = $db->getFieldData($table);
    foreach ($fields as $field) {
        echo "  - $field->name ($field->type)\n";
    }
    echo "\n";
}
