<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\CustomerModel;

class Customer extends BaseController
{
    protected $orderModel;
    protected $customerModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->customerModel = new CustomerModel();
    }

    public function dashboard()
    {
        $id_customer = session()->get('id_customer');
        $orders = $this->orderModel->getOrdersByCustomer($id_customer);
        $data = [
            'title' => 'Dashboard - Bulan Cake & Cookies',
            'orders' => $orders,
            'total_orders' => count($orders),
        ];
        return view('customer/dashboard', $data);
    }

    public function profil()
    {
        $id_customer = session()->get('id_customer');
        $customer = $this->customerModel->find($id_customer);
        $data = [
            'title' => 'Profil Saya - Bulan Cake & Cookies',
            'customer' => $customer,
        ];
        return view('customer/profil', $data);
    }

    public function updateProfil()
    {
        $id_customer = session()->get('id_customer');
        $this->customerModel->update($id_customer, [
            'nama'   => $this->request->getPost('nama'),
            'phone'  => $this->request->getPost('phone'),
            'alamat' => $this->request->getPost('alamat'),
        ]);
        session()->set('nama', $this->request->getPost('nama'));
        return redirect()->to('/customer/profil')->with('success', 'Profil berhasil diperbarui!');
    }

    public function pesanan()
    {
        $id_customer = session()->get('id_customer');
        $keyword = $this->request->getGet('q');
        $orders = $this->orderModel->getOrdersByCustomer($id_customer, $keyword);
        
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($orders);
        }

        $data = [
            'title' => 'Riwayat Pesanan - Bulan Cake & Cookies',
            'orders' => $orders,
        ];
        return view('customer/pesanan', $data);
    }

    public function detailPesanan($token)
    {
        $orderItemModel = new \App\Models\OrderItemModel();
        $paymentModel = new \App\Models\PaymentModel();
        $shippingModel = new \App\Models\ShippingModel();

        $order = $this->orderModel->getOrderDetailByToken($token);
        if (!$order || $order['id_customer'] != session()->get('id_customer')) {
            return redirect()->to('/customer/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Pesanan ORD-' . str_pad($order['id_order'], 4, '0', STR_PAD_LEFT) . ' - Bulan Cake & Cookies',
            'order' => $order,
            'items' => $orderItemModel->getItemsByOrder($order['id_order']),
            'payment' => $paymentModel->getByOrder($order['id_order']),
            'shipping' => $shippingModel->getByOrder($order['id_order']),
        ];
        return view('customer/detail_pesanan', $data);
    }
}
