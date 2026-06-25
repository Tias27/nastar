<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ShippingModel;
use App\Models\OrderModel;

class Shipping extends BaseController
{
    protected $shippingModel;
    protected $orderModel;

    public function __construct()
    {
        $this->shippingModel = new ShippingModel();
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $shippings = $this->shippingModel->getAllWithOrder($keyword);

        if ($this->request->isAJAX()) {
            return view('admin/shipping/_table_rows', ['shippings' => $shippings]);
        }

        $data = [
            'title' => 'Kelola Pengiriman - Admin',
            'shippings' => $shippings,
            'keyword' => $keyword,
        ];
        return view('admin/shipping/index', $data);
    }

    public function update($id)
    {
        $shipping = $this->shippingModel->find($id);
        if (!$shipping) {
            return redirect()->to('/admin/pengiriman')->with('error', 'Data pengiriman tidak ditemukan.');
        }

        $status = $this->request->getPost('status');
        $resi = $this->request->getPost('resi');
        $tanggal_kirim = $this->request->getPost('tanggal_kirim');

        $this->shippingModel->update($id, [
            'status' => $status,
            'resi' => $resi,
            'tanggal_kirim' => $tanggal_kirim ?: null,
        ]);

        if ($status === 'delivered') {
            $this->orderModel->update($shipping['id_order'], ['status' => 'delivered']);
        } elseif ($status === 'shipped') {
            $this->orderModel->update($shipping['id_order'], ['status' => 'shipped']);
        }

        return redirect()->to('/admin/pengiriman')->with('success', 'Status pengiriman diperbarui!');
    }
}
