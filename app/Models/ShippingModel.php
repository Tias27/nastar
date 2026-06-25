<?php

namespace App\Models;

use CodeIgniter\Model;

class ShippingModel extends Model
{
    protected $table = 'shipping';
    protected $primaryKey = 'id_shipping';
    protected $allowedFields = ['id_order', 'alamat_kirim', 'kurir', 'resi', 'status', 'tanggal_kirim'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getByOrder($id_order)
    {
        return $this->where('id_order', $id_order)->first();
    }

    public function getAllWithOrder($keyword = null)
    {
        $builder = $this->select('shipping.*, orders.status as order_status, customers.nama, orders.total_price')
                    ->join('orders', 'orders.id_order = shipping.id_order')
                    ->join('customers', 'customers.id_customer = orders.id_customer');
        
        if ($keyword) {
            $builder->groupStart()
                    ->like('shipping.id_order', $keyword)
                    ->orLike('shipping.resi', $keyword)
                    ->orLike('customers.nama', $keyword)
                    ->groupEnd();
        }

        return $builder->orderBy('shipping.created_at', 'DESC')
                    ->findAll();
    }
}
