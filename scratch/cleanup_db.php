<?php
// Script to finalize DB schema according to final constraints
$db = \Config\Database::connect();
$forge = \Config\Database::forge();

// 1. Drop unused tables
$forge->dropTable('categories', true);
$forge->dropTable('testimonials', true);

// 2. Modify products table
// Check if id_category exists first
$fields = $db->getFieldNames('products');
if (in_array('id_category', $fields)) {
    $forge->dropColumn('products', 'id_category');
}
// Drop other non-diagram fields if necessary (but user said keep gambar and deskripsi)
$toDrop = ['slug', 'is_featured', 'is_active', 'berat'];
foreach ($toDrop as $col) {
    if (in_array($col, $fields)) {
        $forge->dropColumn('products', $col);
    }
}

echo "Database cleanup completed.\n";
