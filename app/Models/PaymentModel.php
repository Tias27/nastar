<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id_payment';
    protected $allowedFields = ['id_order', 'payment_date', 'amount', 'metode', 'bukti_transfer', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getByOrder($id_order)
    {
        return $this->where('id_order', $id_order)->first();
    }

    public function getAllWithOrder()
    {
        return $this->select('payments.*, orders.id_customer, customers.nama, users.username, orders.total_price as order_total')
                    ->join('orders', 'orders.id_order = payments.id_order')
                    ->join('customers', 'customers.id_customer = orders.id_customer')
                    ->join('users', 'users.id_user = customers.id_user')
                    ->orderBy('payments.created_at', 'DESC')
                    ->findAll();
    }

    public function searchPayments($query)
    {
        $builder = $this->select('payments.*, orders.id_customer, customers.nama, users.username, orders.total_price as order_total')
                    ->join('orders', 'orders.id_order = payments.id_order')
                    ->join('customers', 'customers.id_customer = orders.id_customer')
                    ->join('users', 'users.id_user = customers.id_user');
        
        if (!empty($query)) {
            $builder->groupStart()
                    ->like('payments.id_order', $query)
                    ->orLike('users.username', $query)
                    ->orLike('customers.nama', $query)
                    ->groupEnd();
        }
        
        return $builder->orderBy('payments.created_at', 'DESC')
                       ->findAll();
    }
}
