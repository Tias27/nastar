<?php

namespace App\Models;

use CodeIgniter\Model;

class CartItemModel extends Model
{
    protected $table = 'cart_items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_cart', 'id_product', 'quantity', 'price'];
    protected $useTimestamps = false;

    public function getItemsByCart($id_cart)
    {
        return $this->select('cart_items.*, products.nama_product, products.harga, products.stok, products.gambar')
                    ->join('products', 'products.id_product = cart_items.id_product')
                    ->where('cart_items.id_cart', $id_cart)
                    ->findAll();
    }

    public function findByCartAndProduct($id_cart, $id_product)
    {
        return $this->where('id_cart', $id_cart)->where('id_product', $id_product)->first();
    }
}
