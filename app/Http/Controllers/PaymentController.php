<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $orderId = (string) Str::uuid();

        // Create Payment
        $payment = Payment::create([
            'order_id' => $orderId,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $request->amount,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $redirectUrl = Snap::createTransaction($params)->redirect_url;

            $payment->update([
                'snap_token' => $snapToken,
                'redirect_url' => $redirectUrl,
            ]);

            return response()->json([
                'redirect_url' => $redirectUrl,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function webhook(Request $request)
    {
        $payload = $request->all();

        if (! isset($payload['order_id'], $payload['status_code'], $payload['gross_amount'], $payload['signature_key'])) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        $orderId = $payload['order_id'];
        $statusCode = $payload['status_code'];
        $grossAmount = $payload['gross_amount'];

        $signatureKey = hash(
            'sha512',
            $orderId.$statusCode.$grossAmount.config('midtrans.server_key')
        );

        if ($signatureKey !== $payload['signature_key']) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $payment = Payment::where('order_id', $orderId)->first();
        if (! $payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        DB::transaction(function () use ($payment, $payload, $orderId) {
            $transactionStatus = $payload['transaction_status'] ?? '';
            $status = 'pending';

            if (in_array($transactionStatus, ['capture', 'settlement'])) {
                $status = 'paid';
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'failure'])) {
                $status = 'failed';
            } elseif ($transactionStatus === 'expire') {
                $status = 'expired';
            }

            $payment->update([
                'status' => $status,
                'transaction_id' => $payload['transaction_id'] ?? null,
                'payment_type' => $payload['payment_type'] ?? null,
                'payload' => $payload,
            ]);

            // Update Transaction model
            if ($status === 'paid') {
                $transaction = Transaction::where('booking_trx_id', $orderId)->first();
                if ($transaction) {
                    $transaction->update(['is_paid' => true]);
                    try {
                        \Illuminate\Support\Facades\Mail::to($transaction->email)->send(new \App\Mail\InvoiceMail($transaction));
                    } catch (\Exception $e) {
                        \Illuminate\Support\Facades\Log::error('Failed to send invoice email: ' . $e->getMessage());
                    }
                }
            } elseif (in_array($status, ['failed', 'expired', 'cancelled'])) {
                Transaction::where('booking_trx_id', $orderId)
                    ->update(['is_paid' => false]);
            }
        });

        return response()->json(['message' => 'Webhook received successfully']);
    }

    public function success(Request $request)
    {
        return redirect()->route('checkout', ['order_id' => $request->order_id]);
    }

    public function pending(Request $request)
    {
        return redirect()->route('checkout', ['order_id' => $request->order_id]);
    }

    public function failed(Request $request)
    {
        return redirect()->route('checkout', ['order_id' => $request->order_id]);
    }
}
