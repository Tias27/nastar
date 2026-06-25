<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInitialSchema extends Migration
{
    public function up()
    {
        // ================================================
        // TABEL: users
        // ================================================
        $this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'customer'],
                'default'    => 'customer',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->addUniqueKey('username');
        if (!$this->db->tableExists('users')) {
            $this->forge->createTable('users');
        }

        // ================================================
        // TABEL: customers
        // ================================================
        $this->forge->addField([
            'id_customer' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_customer', true);
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        if (!$this->db->tableExists('customers')) {
            $this->forge->createTable('customers');
        }

        // ================================================
        // TABEL: categories
        // ================================================
        $this->forge->addField([
            'id_category' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'nama_category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_category', true);
        $this->forge->addUniqueKey('slug');
        if (!$this->db->tableExists('categories')) {
            $this->forge->createTable('categories');
        }

        // ================================================
        // TABEL: products
        // ================================================
        $this->forge->addField([
            'id_product' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_category' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'nama_product' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'harga' => [
                'type'       => 'DECIMAL',
                'constraint' => [12, 2],
                'default'    => 0,
            ],
            'stok' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'berat' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'is_featured' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_product', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addForeignKey('id_category', 'categories', 'id_category', 'SET NULL', 'CASCADE');
        if (!$this->db->tableExists('products')) {
            $this->forge->createTable('products');
        }

        // ================================================
        // TABEL: cart
        // ================================================
        $this->forge->addField([
            'id_cart' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_customer' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'total_price' => [
                'type'       => 'DECIMAL',
                'constraint' => [14, 2],
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_cart', true);
        $this->forge->addForeignKey('id_customer', 'customers', 'id_customer', 'CASCADE', 'CASCADE');
        if (!$this->db->tableExists('cart')) {
            $this->forge->createTable('cart');
        }

        // ================================================
        // TABEL: cart_items
        // ================================================
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_cart' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'id_product' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => [12, 2],
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_cart', 'cart', 'id_cart', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_product', 'products', 'id_product', 'CASCADE', 'CASCADE');
        if (!$this->db->tableExists('cart_items')) {
            $this->forge->createTable('cart_items');
        }

        // ================================================
        // TABEL: orders
        // ================================================
        $this->forge->addField([
            'id_order' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'order_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'id_customer' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'total_price' => [
                'type'       => 'DECIMAL',
                'constraint' => [14, 2],
                'default'    => 0,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'processing', 'shipped', 'delivered', 'cancelled'],
                'default'    => 'pending',
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_order', true);
        $this->forge->addForeignKey('id_customer', 'customers', 'id_customer', 'CASCADE', 'CASCADE');
        if (!$this->db->tableExists('orders')) {
            $this->forge->createTable('orders');
        }

        // ================================================
        // TABEL: order_items
        // ================================================
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_order' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'id_product' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => [12, 2],
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_order', 'orders', 'id_order', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_product', 'products', 'id_product', 'CASCADE', 'CASCADE');
        if (!$this->db->tableExists('order_items')) {
            $this->forge->createTable('order_items');
        }

        // ================================================
        // TABEL: payments
        // ================================================
        $this->forge->addField([
            'id_payment' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_order' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'payment_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'amount' => [
                'type'       => 'DECIMAL',
                'constraint' => [14, 2],
            ],
            'metode' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'transfer',
            ],
            'bukti_transfer' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['unpaid', 'pending', 'paid', 'failed'],
                'default'    => 'unpaid',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_payment', true);
        $this->forge->addForeignKey('id_order', 'orders', 'id_order', 'CASCADE', 'CASCADE');
        if (!$this->db->tableExists('payments')) {
            $this->forge->createTable('payments');
        }

        // ================================================
        // TABEL: shipping
        // ================================================
        $this->forge->addField([
            'id_shipping' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_order' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'alamat_kirim' => [
                'type' => 'TEXT',
            ],
            'kurir' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'resi' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'processing', 'shipped', 'delivered'],
                'default'    => 'pending',
            ],
            'tanggal_kirim' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_shipping', true);
        $this->forge->addUniqueKey('id_order');
        $this->forge->addForeignKey('id_order', 'orders', 'id_order', 'CASCADE', 'CASCADE');
        if (!$this->db->tableExists('shipping')) {
            $this->forge->createTable('shipping');
        }

        // ================================================
        // TABEL: testimonials
        // ================================================
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'id_customer' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'id_product' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'pesan' => [
                'type' => 'TEXT',
            ],
            'rating' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 5,
            ],
            'is_approved' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_customer', 'customers', 'id_customer', 'SET NULL', 'CASCADE');
        $this->forge->addForeignKey('id_product', 'products', 'id_product', 'SET NULL', 'CASCADE');
        if (!$this->db->tableExists('testimonials')) {
            $this->forge->createTable('testimonials');
        }

        // ================================================
        // TABEL: reports
        // ================================================
        $this->forge->addField([
            'id_report' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
            ],
            'periode' => [
                'type' => 'DATE',
            ],
            'total_sales' => [
                'type'       => 'DECIMAL',
                'constraint' => [16, 2],
                'default'    => 0,
            ],
            'total_orders' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'total_items_sold' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_report', true);
        if (!$this->db->tableExists('reports')) {
            $this->forge->createTable('reports');
        }
    }

    public function down()
    {
        $this->forge->dropTable('reports', true);
        $this->forge->dropTable('testimonials', true);
        $this->forge->dropTable('shipping', true);
        $this->forge->dropTable('payments', true);
        $this->forge->dropTable('order_items', true);
        $this->forge->dropTable('orders', true);
        $this->forge->dropTable('cart_items', true);
        $this->forge->dropTable('cart', true);
        $this->forge->dropTable('products', true);
        $this->forge->dropTable('categories', true);
        $this->forge->dropTable('customers', true);
        $this->forge->dropTable('users', true);
    }
}
