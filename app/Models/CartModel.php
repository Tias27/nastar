<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id_cart';
    protected $allowedFields = ['id_customer', 'total_price'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getCartByCustomer($id_customer)
    {
        return $this->where('id_customer', $id_customer)->first();
    }

    public function updateTotal($id_cart)
    {
        $db = \Config\Database::connect();
        $result = $db->query('SELECT SUM(price * quantity) AS total FROM cart_items WHERE id_cart = ?', [$id_cart]);
        $row = $result->getRow();
        $total = $row->total ?? 0;

        $this->update($id_cart, ['total_price' => $total]);
        return $total;
    }
}
