<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PaymentModel;
use App\Models\OrderModel;

class Payments extends BaseController
{
    protected $paymentModel;
    protected $orderModel;

    public function __construct()
    {
        $this->paymentModel = new PaymentModel();
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Pembayaran - Admin',
            'payments' => $this->paymentModel->getAllWithOrder(),
        ];
        return view('admin/payments/index', $data);
    }

    public function konfirmasi($id)
    {
        $payment = $this->paymentModel->find($id);
        if ($payment) {
            $this->paymentModel->update($id, [
                'status' => 'paid',
                'payment_date' => date('Y-m-d H:i:s'),
            ]);
            $this->orderModel->update($payment['id_order'], ['status' => 'processing']);
        }
        return redirect()->to('/admin/pembayaran')->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    public function verifikasi($id, $status)
    {
        $payment = $this->paymentModel->find($id);
        if ($payment) {
            $updateData = ['status' => $status];
            if ($status == 'paid') {
                $updateData['payment_date'] = date('Y-m-d H:i:s');
                $this->orderModel->update($payment['id_order'], ['status' => 'processing']);
            } elseif ($status == 'rejected') {
                $this->orderModel->update($payment['id_order'], ['status' => 'cancelled']);
            }
            $this->paymentModel->update($id, $updateData);
        }
        return redirect()->to('/admin/pembayaran')->with('success', 'Status pembayaran diperbarui!');
    }

    public function search()
    {
        $query = $this->request->getGet('query');
        $payments = $this->paymentModel->searchPayments($query);
        return view('admin/payments/_table_rows', ['payments' => $payments]);
    }
}
