<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_order';
    protected $allowedFields = ['order_token', 'order_date', 'id_customer', 'total_price', 'status', 'catatan'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getOrdersByCustomer($id_customer, $keyword = null)
    {
        $builder = $this->select('orders.*, shipping.resi, shipping.kurir as kurir_shipping')
                        ->join('shipping', 'shipping.id_order = orders.id_order', 'left')
                        ->where('orders.id_customer', $id_customer);
        
        if ($keyword) {
            $builder->groupStart()
                 ->like('orders.id_order', $keyword)
                 ->orLike('orders.status', $keyword)
                 ->orLike('shipping.resi', $keyword)
                 ->groupEnd();
        }
        return $builder->orderBy('orders.created_at', 'DESC')
                    ->findAll();
    }

    public function getOrderDetail($id_order)
    {
        return $this->select('orders.*, customers.nama, customers.phone, customers.alamat, users.username, shipping.resi, shipping.kurir as shipping_kurir, shipping.alamat_kirim')
                    ->join('customers', 'customers.id_customer = orders.id_customer')
                    ->join('users', 'users.id_user = customers.id_user')
                    ->join('shipping', 'shipping.id_order = orders.id_order', 'left')
                    ->where('orders.id_order', $id_order)
                    ->first();
    }

    public function getOrderDetailByToken($token)
    {
        return $this->select('orders.*, customers.nama, customers.phone, customers.alamat, users.username, shipping.resi, shipping.kurir as shipping_kurir, shipping.alamat_kirim')
                    ->join('customers', 'customers.id_customer = orders.id_customer')
                    ->join('users', 'users.id_user = customers.id_user')
                    ->join('shipping', 'shipping.id_order = orders.id_order', 'left')
                    ->where('orders.order_token', $token)
                    ->first();
    }

    public function getAllOrdersWithCustomer($status = null)
    {
        $builder = $this->select('orders.*, customers.nama, customers.phone, users.username')
                    ->join('customers', 'customers.id_customer = orders.id_customer')
                    ->join('users', 'users.id_user = customers.id_user');
        
        if ($status) {
            $builder->where('orders.status', $status);
        }
        
        return $builder->orderBy('orders.created_at', 'DESC')
                    ->findAll();
    }

    public function searchOrders($query, $status = null)
    {
        $builder = $this->select('orders.*, customers.nama, customers.phone, users.username')
                    ->join('customers', 'customers.id_customer = orders.id_customer')
                    ->join('users', 'users.id_user = customers.id_user');
        
        if ($status) {
            $builder->where('orders.status', $status);
        }

        if ($query) {
            $builder->groupStart()
                    ->like('orders.id_order', $query)
                    ->orLike('customers.nama', $query)
                    ->orLike('users.username', $query)
                    ->groupEnd();
        }
        
        return $builder->orderBy('orders.created_at', 'DESC')
                    ->findAll();
    }
}
