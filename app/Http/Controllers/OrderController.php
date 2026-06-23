<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerDataRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\OrderService;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function saveOrder(StoreOrderRequest $request, Product $product)
    {
        $validated = $request->validated();
        $validated['product_id'] = $product->id;
        $validated['quantity'] = $validated['product_quantity']; // Sync with Service
        $this->orderService->beginOrder($validated);

        return redirect()->route('front.booking', $product->slug);
    }

    public function booking()
    {
        $data = $this->orderService->getOrderDetails();

        return view('order.order', $data);
    }

    public function customerData()
    {
        $data = $this->orderService->getOrderDetails();

        return view('order.customer_data', $data);
    }

    public function saveCustomerData(StoreCustomerDataRequest $request)
    {
        $validated = $request->validated();
        $this->orderService->updateCustomerData($validated);

        return redirect()->route('front.payment');
    }

    public function payment()
    {
        $data = $this->orderService->getOrderDetails();

        return view('order.payment', $data);
    }

    public function paymentConfirm(StorePaymentRequest $request)
    {
        $validated = $request->validated();
        $productTransactionId = $this->orderService->paymentConfirm($validated);

        if ($productTransactionId) {
            $trx = Transaction::find($productTransactionId);

            // Midtrans Integration
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            $params = [
                'transaction_details' => [
                    'order_id' => $trx->booking_trx_id,
                    'gross_amount' => $trx->grand_total_amount,
                ],
                'customer_details' => [
                    'first_name' => $trx->name,
                    'email' => $trx->email,
                    'phone' => $trx->phone,
                ],
                'callbacks' => [
                    'finish' => route('payment.success'),
                    'unfinish' => route('payment.pending'),
                    'error' => route('payment.failed'),
                ],
            ];

            try {
                $snapToken = Snap::getSnapToken($params);
                $redirectUrl = Snap::createTransaction($params)->redirect_url;

                Payment::create([
                    'order_id' => $trx->booking_trx_id,
                    'amount' => $trx->grand_total_amount,
                    'status' => 'pending',
                    'snap_token' => $snapToken,
                    'redirect_url' => $redirectUrl,
                ]);

                return redirect()->away($redirectUrl);
            } catch (\Exception $e) {
                return redirect()->route('front.order_finished', $productTransactionId)->withErrors(['error' => 'Payment initiation failed: '.$e->getMessage()]);
            }
        }

        return redirect()->route('frontindex')->withErrors(['error' => 'Payment failed. Please try again.']);
    }

    public function orderFinished(Transaction $transaction)
    {
        dd($transaction);
    }
}
