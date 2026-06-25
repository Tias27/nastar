<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\PaymentModel;
use App\Models\ShippingModel;

class Orders extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        $status = $this->request->getGet('status');
        $orders = $this->orderModel->getAllOrdersWithCustomer($status);

        $data = [
            'title' => 'Kelola Pesanan - Admin',
            'orders' => $orders,
        ];
        return view('admin/orders/index', $data);
    }

    public function detail($id)
    {
        $orderItemModel = new OrderItemModel();
        $paymentModel = new PaymentModel();
        $shippingModel = new ShippingModel();

        $order = $this->orderModel->getOrderDetail($id);
        if (!$order) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Pesanan #' . $id . ' - Admin',
            'order' => $order,
            'items' => $orderItemModel->getItemsByOrder($id),
            'payment' => $paymentModel->getByOrder($id),
            'shipping' => $shippingModel->getByOrder($id),
        ];
        return view('admin/orders/detail', $data);
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        $resi = $this->request->getPost('resi');
        
        $this->orderModel->update($id, ['status' => $status]);
        
        
        if ($resi || $status == 'shipped') {
            $shippingModel = new ShippingModel();
            $shipping = $shippingModel->where('id_order', $id)->first();
            if ($shipping) {
                $shippingModel->update($shipping['id_shipping'], [
                    'resi' => $resi,
                    'status' => $status == 'shipped' ? 'shipped' : $shipping['status'],
                    'tanggal_kirim' => $status == 'shipped' ? date('Y-m-d H:i:s') : $shipping['tanggal_kirim']
                ]);
            }
        }

        return redirect()->to('/admin/pesanan/' . $id)->with('success', 'Status pesanan diperbarui!');
    }

    public function setStatus($id, $status)
    {
        $this->orderModel->update($id, ['status' => $status]);
        
        
        if ($status == 'processing') {
            $paymentModel = new PaymentModel();
            $payment = $paymentModel->where('id_order', $id)->first();
            if ($payment && $payment['status'] == 'pending') {
                $paymentModel->update($payment['id_payment'], ['status' => 'paid']);
            }
        }

        return redirect()->back()->with('success', 'Status pesanan #' . $id . ' diperbarui menjadi ' . $status);
    }

    public function kirim($id)
    {
        $resi = 'NST-' . strtoupper(bin2hex(random_bytes(4)));
        
        $this->orderModel->update($id, ['status' => 'shipped']);
        
        $shippingModel = new ShippingModel();
        $shipping = $shippingModel->where('id_order', $id)->first();
        if ($shipping) {
            $shippingModel->update($shipping['id_shipping'], [
                'resi' => $resi,
                'status' => 'shipped',
                'tanggal_kirim' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->back()->with('success', 'Barang berhasil dikirim! Resi: ' . $resi);
    }

    public function updateResi($id)
    {
        $resi = $this->request->getPost('resi');
        
        $shippingModel = new ShippingModel();
        $shipping = $shippingModel->where('id_order', $id)->first();
        if ($shipping) {
            $shippingModel->update($shipping['id_shipping'], [
                'resi' => $resi
            ]);
        }

        return redirect()->back()->with('success', 'Nomor Resi berhasil diperbarui.');
    }
    public function search()
    {
        if ($this->request->isAJAX()) {
            $query = $this->request->getGet('query');
            $status = $this->request->getGet('status');
            
            $orders = $this->orderModel->searchOrders($query, $status);
            
            return view('admin/orders/_table_rows', ['orders' => $orders]);
        }
    }
}
