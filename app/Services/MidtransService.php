<?php

namespace App\Services;

use App\Models\Order;
use Exception;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    public function createSnapToken(Order $order): string
    {
        // 1. Cek jika sudah ada token di database untuk efisiensi
        if ($order->snap_token) {
            return $order->snap_token;
        }

        if ($order->items->isEmpty()) {
            throw new Exception('Order tidak memiliki item.');
        }

        // 2. Siapkan ID unik untuk Midtrans (Order Number + Timestamp)
        $midtransOrderId = $order->order_number . '-' . time();

        // 3. Susun Transaction Details (Didefinisikan SEBELUM dimasukkan ke $params)
        $transactionDetails = [
            'order_id'     => $midtransOrderId,
            'gross_amount' => (int) $order->total_amount,
        ];

        // 4. Susun Customer Details
        $customerDetails = [
            'first_name' => $order->user->name,
            'email'      => $order->user->email,
            'phone'      => $order->shipping_phone ?? $order->user->phone ?? '',
        ];

        // 5. Susun Item Details
        $itemDetails = $order->items->map(function ($item) {
            return [
                'id'       => (string) $item->product_id,
                'price'    => (int) $item->price,
                'quantity' => (int) $item->quantity,
                'name'     => substr($item->product_name, 0, 50),
            ];
        })->toArray();

        if ($order->shipping_cost > 0) {
            $itemDetails[] = [
                'id'       => 'SHIPPING',
                'price'    => (int) $order->shipping_cost,
                'quantity' => 1,
                'name'     => 'Biaya Pengiriman',
            ];
        }

        // 6. Gabungkan semua ke dalam $params
        $params = [
            'transaction_details' => $transactionDetails,
            'customer_details'    => $customerDetails,
            'item_details'       => $itemDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            // Simpan snap_token dan midtrans_order_id ke database
            $order->update([
                'snap_token' => $snapToken,
                'midtrans_order_id' => $midtransOrderId
            ]);

            return $snapToken;
        } catch (Exception $e) {
            logger()->error('Midtrans Error: ' . $e->getMessage());
            throw new Exception('Gagal membuat Snap Token: ' . $e->getMessage());
        }
    }

    public function checkStatus(string $orderId)
    {
        try {
            return Transaction::status($orderId);
        } catch (Exception $e) {
            throw new Exception('Gagal mengecek status: ' . $e->getMessage());
        }
    }
}