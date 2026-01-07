<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;
use App\Events\OrderPaidEvent;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * HALAMAN BAYAR
     */
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.pay', compact('order'));
    }

    /**
     * AMBIL SNAP TOKEN (AJAX)
     */
   /**
 * AMBIL SNAP TOKEN (AJAX)
 */
public function snap(Order $order, MidtransService $midtransService)
{
    // ... kode pengecekan auth & status (tetap sama) ...

    $snapResponse = $midtransService->createSnapToken($order);

    if (is_array($snapResponse)) {
        $snapToken = $snapResponse['token'] ?? null;
        $midtransOrderId = $snapResponse['midtrans_order_id'] ?? $order->order_number;
    } else {
        $snapToken = $snapResponse;
        $midtransOrderId = $order->order_number;
    }

    $order->update(['snap_token' => $snapToken]);

    return response()->json([
        'token' => $snapToken,
        'midtrans_order_id' => $midtransOrderId,
        'order_id' => $order->id // TAMBAHKAN INI agar JS bisa baca ID-nya
    ]);
}

/**
 * SUCCESS PAGE
 */
public function success(Order $order, MidtransService $midtransService)
{
    // Coba cek status transaksi langsung via Midtrans sebagai fallback
    // jika webhook belum ter-trigger atau tidak sampai ke server.
    try {
            $midtransOrderId = $order->midtrans_order_id ?? $order->order_number;
            $status = $midtransService->checkStatus($midtransOrderId);
    } catch (Exception $e) {
        return view('orders.success', compact('order'));
    }

    $transactionStatus = $status->transaction_status ?? $status['transaction_status'] ?? null;
    $fraudStatus = $status->fraud_status ?? $status['fraud_status'] ?? null;

    if ($transactionStatus === 'capture') {
        if ($fraudStatus === 'challenge') {
            $order->update(['status' => 'pending']);
            $order->payment?->update(['status' => 'pending']);
        } else {
            // Payment successful -> complete the order
            $order->update(['status' => 'completed', 'payment_status' => 'paid']);
            $order->payment?->update([
                'status' => 'success',
                'midtrans_transaction_id' => $status->transaction_id ?? null,
                'paid_at' => now(),
            ]);
            event(new OrderPaidEvent($order));
        }
    } elseif ($transactionStatus === 'settlement') {
        $order->update(['status' => 'completed', 'payment_status' => 'paid']);
        $order->payment?->update([
            'status' => 'success',
            'midtrans_transaction_id' => $status->transaction_id ?? null,
            'paid_at' => now(),
        ]);
        event(new OrderPaidEvent($order));
    } elseif ($transactionStatus === 'pending') {
        $order->update(['status' => 'pending']);
        $order->payment?->update(['status' => 'pending']);
    } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
        $order->update(['status' => 'cancelled']);
        $order->payment?->update(['status' => 'failed']);
    }

    return view('orders.success', compact('order'));
}

/**
 * PENDING PAGE
 */
public function pending(Order $order) // Tambahkan parameter Order $order
{
    return view('orders.pending', compact('order'));
}

/**
 * HANDLE WEBHOOK DARI MIDTRANS
 * Fungsi ini yang akan dipanggil Midtrans di belakang layar (server-to-server)
 */
public function callback(Request $request, MidtransService $midtransService)
{
    try {
        // Ambil data dari request Midtrans
        $notification = $request->all();
        $orderNumber = $notification['order_id'];

        // Cari order berdasarkan order_number
        $order = Order::where('order_number', $orderNumber)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Gunakan checkStatus dari service kamu untuk validasi keamanan (Signature Key)
        $status = $midtransService->checkStatus($orderNumber);
        
        $transactionStatus = $status->transaction_status;
        $fraudStatus = $status->fraud_status;

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $order->update(['status' => 'pending']);
            } else {
                $this->markAsPaid($order, $status);
            }
        } elseif ($transactionStatus == 'settlement') {
            $this->markAsPaid($order, $status);
        } elseif ($transactionStatus == 'pending') {
            $order->update(['status' => 'pending']);
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            $order->update(['status' => 'cancelled']);
        }

        return response()->json(['message' => 'OK']);

    } catch (\Exception $e) {
                    if (!empty($midtransOrderId)) {
                        $order->update(['midtrans_order_id' => $midtransOrderId]);
                    }
        return response()->json(['message' => $e->getMessage()], 500);
    }
}

/**
 * Helper untuk update status berbayar
 */
private function markAsPaid($order, $status)
{
    $order->update([
        'status' => 'completed', 
        'payment_status' => 'paid'
    ]);
    
    // Jika kamu punya tabel payments, update juga
    if ($order->payment) {
        $order->payment->update([
            'status' => 'success',
            'midtrans_transaction_id' => $status->transaction_id,
            'paid_at' => now(),
        ]);
    }
    
    event(new OrderPaidEvent($order));
}
}
