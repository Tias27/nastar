<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_order', 'id_product', 'quantity', 'price'];
    protected $useTimestamps = false;

    public function getItemsByOrder($id_order)
    {
        return $this->select('order_items.*, products.nama_product, products.gambar')
                    ->join('products', 'products.id_product = order_items.id_product')
                    ->where('order_items.id_order', $id_order)
                    ->findAll();
    }
}
