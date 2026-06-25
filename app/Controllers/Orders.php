<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\PaymentModel;
use App\Models\ShippingModel;
use Midtrans\Config;
use Midtrans\Snap;

class Orders extends BaseController
{
    protected $orderModel;
    protected $orderItemModel;
    protected $paymentModel;
    protected $shippingModel;

    protected $productModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
        $this->paymentModel = new PaymentModel();
        $this->shippingModel = new ShippingModel();
        $this->productModel = new \App\Models\ProductModel();
    }

    private function reduceStock($id_order)
    {
        $items = $this->orderItemModel->getItemsByOrder($id_order);
        foreach ($items as $item) {
            $product = $this->productModel->find($item['id_product']);
            if ($product) {
                $newStock = max(0, $product['stok'] - $item['quantity']);
                $this->productModel->update($item['id_product'], ['stok' => $newStock]);
            }
        }
    }

    public function bayar($token)
    {
        $order = $this->orderModel->getOrderDetailByToken($token);
        if (!$order || $order['id_customer'] != session()->get('id_customer')) {
            return redirect()->to('/customer/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        
        if ($order['status'] !== 'pending') {
            return redirect()->to('/customer/pesanan/' . $token)->with('info', 'Pesanan ini sudah dibayar atau sedang diproses.');
        }

        $payment = $this->paymentModel->getByOrder($order['id_order']);
        $items = $this->orderItemModel->getItemsByOrder($order['id_order']);

        
        $midtransConfig = config('Midtrans');
        Config::$serverKey = $midtransConfig->serverKey;
        Config::$isProduction = $midtransConfig->isProduction;
        Config::$isSanitized = $midtransConfig->isSanitized;
        Config::$is3ds = $midtransConfig->is3ds;

        
        if (ENVIRONMENT === 'development') {
            Config::$curlOptions = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => []
            ];
        }

        $total_bayar = $order['total_price'];

        $params = [
            'transaction_details' => [
                'order_id' => $order['id_order'],
                'gross_amount' => $total_bayar,
            ],
            'customer_details' => [
                'first_name' => esc($order['nama']),
                'email' => esc(session()->get('email') ?? 'cust@nastar.com'),
                'phone' => esc($order['phone']),
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        $data = [
            'title' => 'Pembayaran Pesanan #' . $order['id_order'],
            'order' => $order,
            'items' => $items,
            'payment' => $payment,
            'snapToken' => $snapToken,
            'midtransClientKey' => $midtransConfig->clientKey,
        ];
        return view('orders/bayar', $data);
    }

    public function uploadBukti($token)
    {
        $order = $this->orderModel->getOrderDetailByToken($token);
        if (!$order || $order['id_customer'] != session()->get('id_customer')) {
            return redirect()->to('/customer/pesanan')->with('error', 'Akses ditolak.');
        }

        $file = $this->request->getFile('bukti_transfer');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/bukti', $newName);

            
            $payment = $this->paymentModel->where('id_order', $order['id_order'])->first();
            if ($payment) {
                $this->paymentModel->update($payment['id_payment'], [
                    'bukti_transfer' => $newName,
                    'status' => 'pending',
                    'payment_date' => date('Y-m-d H:i:s'),
                    'metode' => 'Transfer Bank (Manual)'
                ]);
            } else {
                $this->paymentModel->insert([
                    'id_order' => $order['id_order'],
                    'amount' => $order['total_price'],
                    'bukti_transfer' => $newName,
                    'status' => 'pending',
                    'payment_date' => date('Y-m-d H:i:s'),
                    'metode' => 'Transfer Bank (Manual)'
                ]);
            }

            return redirect()->to('/customer/pesanan/' . $token)->with('success', 'Bukti transfer berhasil diunggah! Tunggu verifikasi admin.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah bukti.');
    }

    public function sukses($token)
    {
        $order = $this->orderModel->getOrderDetailByToken($token);
        if (!$order || $order['id_customer'] != session()->get('id_customer')) {
            return redirect()->to('/customer/pesanan')->with('error', 'Akses ditolak.');
        }

        
        $midtransConfig = config('Midtrans');
        Config::$serverKey = $midtransConfig->serverKey;
        Config::$isProduction = $midtransConfig->isProduction;

        
        if (ENVIRONMENT === 'development') {
            Config::$curlOptions = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => []
            ];
        }

        try {
            $status = \Midtrans\Transaction::status($order['id_order']);
            $payment_type = $status->payment_type;
            $transaction_status = $status->transaction_status;

            if ($transaction_status == 'settlement' || $transaction_status == 'capture') {
                if ($order['status'] !== 'processing' && $order['status'] !== 'shipped' && $order['status'] !== 'delivered') {
                    
                    $this->reduceStock($order['id_order']);

                    
                    $this->orderModel->update($order['id_order'], ['status' => 'processing']);
                    $this->paymentModel->where('id_order', $order['id_order'])->set([
                        'status' => 'paid',
                        'metode' => 'Midtrans (' . strtoupper(str_replace('_', ' ', $payment_type)) . ')',
                        'payment_date' => date('Y-m-d H:i:s')
                    ])->update();
                }
            }
        } catch (\Exception $e) {
            
        }

        $data = [
            'title' => 'Pesanan Berhasil - Nastar Store',
            'order' => $order,
        ];
        return view('orders/sukses', $data);
    }

    
    public function notification()
    {
        $midtransConfig = config('Midtrans');
        Config::$serverKey = $midtransConfig->serverKey;
        Config::$isProduction = $midtransConfig->isProduction;

        try {
            $notif = new \Midtrans\Notification();
        } catch (\Exception $e) {
            return;
        }

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        $order = $this->orderModel->find($order_id);
        if (!$order) return;

        $status = 'pending';
        $payment_status = 'pending';
        $shouldReduceStock = false;

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $status = 'pending';
                    $payment_status = 'pending';
                } else {
                    $status = 'processing';
                    $payment_status = 'paid';
                    $shouldReduceStock = true;
                }
            }
        } elseif ($transaction == 'settlement') {
            $status = 'processing';
            $payment_status = 'paid';
            $shouldReduceStock = true;
        } elseif ($transaction == 'pending') {
            $status = 'pending';
            $payment_status = 'pending';
        } elseif ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
            $status = 'cancelled';
            $payment_status = 'failed';
        }

        if ($shouldReduceStock && $order['status'] !== 'processing' && $order['status'] !== 'shipped' && $order['status'] !== 'delivered') {
            $this->reduceStock($order_id);
        }

        
        $this->orderModel->update($order_id, ['status' => $status]);

        
        $this->paymentModel->where('id_order', $order_id)->set([
            'status' => $payment_status,
            'metode' => 'Midtrans (' . strtoupper(str_replace('_', ' ', $type)) . ')',
            'payment_date' => date('Y-m-d H:i:s')
        ])->update();
    }

    
    public function simulatePayment($token)
    {
        
        $order = $this->orderModel->where('order_token', $token)->first();
        if (!$order || $order['id_customer'] != session()->get('id_customer')) {
            return redirect()->to('/customer/pesanan')->with('error', 'Akses ditolak.');
        }

        
        if ($order['status'] !== 'pending') {
             return redirect()->back();
        }

        
        $midtransConfig = config('Midtrans');
        Config::$serverKey = $midtransConfig->serverKey;
        Config::$isProduction = $midtransConfig->isProduction;

        
        if (ENVIRONMENT === 'development') {
            Config::$curlOptions = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => []
            ];
        }

        $metode_final = 'Simulasi (Localhost)';
        try {
            $status = \Midtrans\Transaction::status($order['id_order']);
            $metode_final = 'Midtrans (' . strtoupper(str_replace('_', ' ', $status->payment_type)) . ')';
        } catch (\Exception $e) {
            
        }

        
        $this->reduceStock($order['id_order']);

        
        $this->orderModel->update($order['id_order'], ['status' => 'processing']);

        
        $this->paymentModel->where('id_order', $order['id_order'])->set([
            'status' => 'paid',
            'payment_date' => date('Y-m-d H:i:s'),
            'metode' => $metode_final
        ])->update();

        return redirect()->to('/customer/pesanan')->with('success', 'PEMBAYARAN BERHASIL! Tunggu untuk pengiriman.');
    }
}
