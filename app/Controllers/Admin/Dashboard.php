<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\CustomerModel;
use App\Models\PaymentModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $orderModel = new OrderModel();
        $customerModel = new CustomerModel();
        $paymentModel = new PaymentModel();

        $db = \Config\Database::connect();

        $totalRevenue = $db->table('payments')
            ->selectSum('amount')
            ->where('status', 'paid')
            ->get()->getRow()->amount ?? 0;

        $data = [
            'title' => 'Dashboard Admin - Bulan Cake & Cookies',
            'total_products' => $productModel->countAll(),
            'total_orders' => $orderModel->countAll(),
            'total_customers' => $customerModel->countAll(),
            'total_revenue' => $totalRevenue,
            'recent_orders' => $orderModel->getAllOrdersWithCustomer(),
            'pending_orders' => $orderModel->where('status', 'pending')->countAllResults(),
            'processing_orders' => $orderModel->where('status', 'processing')->countAllResults(),
        ];
        return view('admin/dashboard', $data);
    }
}
