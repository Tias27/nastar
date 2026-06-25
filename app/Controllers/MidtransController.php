<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\PaymentModel;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends BaseController
{
    public function notification()
    {
        $midtransConfig = config('Midtrans');
        Config::$serverKey = $midtransConfig->serverKey;
        Config::$isProduction = $midtransConfig->isProduction;

        try {
            $notif = new Notification();
        } catch (\Exception $e) {
            return $this->response->setStatusCode(400)->setBody('Invalid notification');
        }

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        
        $parts = explode('-', $order_id);
        if (count($parts) < 2) return $this->response->setBody('Invalid Order ID');
        $id_order = $parts[1];

        $orderModel = new OrderModel();
        $paymentModel = new PaymentModel();

        $payment = $paymentModel->where('id_order', $id_order)->first();
        if (!$payment) return $this->response->setBody('Payment record not found');

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    
                    
                } else {
                    $this->updateSuccess($paymentModel, $orderModel, $payment['id_payment'], $id_order);
                }
            }
        } else if ($transaction == 'settlement') {
            $this->updateSuccess($paymentModel, $orderModel, $payment['id_payment'], $id_order);
        } else if ($transaction == 'pending') {
            $paymentModel->update($payment['id_payment'], ['status' => 'pending']);
        } else if ($transaction == 'deny') {
            $paymentModel->update($payment['id_payment'], ['status' => 'failed']);
            $orderModel->update($id_order, ['status' => 'cancelled']);
        } else if ($transaction == 'expire') {
            $paymentModel->update($payment['id_payment'], ['status' => 'expired']);
            $orderModel->update($id_order, ['status' => 'cancelled']);
        } else if ($transaction == 'cancel') {
            $paymentModel->update($payment['id_payment'], ['status' => 'cancelled']);
            $orderModel->update($id_order, ['status' => 'cancelled']);
        }

        return $this->response->setBody('Notification handled');
    }

    private function updateSuccess($paymentModel, $orderModel, $id_payment, $id_order)
    {
        $paymentModel->update($id_payment, [
            'status' => 'paid',
            'payment_date' => date('Y-m-d H:i:s'),
            'metode' => 'Midtrans'
        ]);
        $orderModel->update($id_order, ['status' => 'processing']);
    }
}
