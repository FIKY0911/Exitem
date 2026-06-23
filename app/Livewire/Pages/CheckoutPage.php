<?php

namespace App\Livewire\Pages;

use App\Models\BillingProfile;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutPage extends Component
{
    #[Url]
    public ?string $order_id = null;

    public $paymentRecord = null;
    // Billing fields
    public string $first_name = '';

    public string $address = '';

    public string $city = '';

    public string $phone = '';

    public bool $save_info = false;

    public bool $hasSavedBilling = false;

    protected CartService $cart;

    public function boot(CartService $cart): void
    {
        $this->cart = $cart;
    }

    public function checkPaymentStatus()
    {
        if ($this->order_id) {
            $this->paymentRecord = Payment::where('order_id', $this->order_id)->first();
        }
    }

    public function mount(): void
    {
        $user = Auth::user();
        $billing = $user->billingProfile;

        if ($billing) {
            $this->hasSavedBilling = true;
            $this->first_name = $billing->name;
            $this->phone = $billing->phone;
            $this->address = $billing->address;
            $this->city = $billing->city;
        }

        $this->checkPaymentStatus();
    }

    protected function rules(): array
    {
        return [
            'first_name' => 'required|string|min:2',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone' => ['required', 'regex:/^\+?[0-9]+$/', 'min:10'],
        ];
    }

    protected $messages = [
        'first_name.required' => 'Please fill First Name.',
        'address.required' => 'Please fill Street Address.',
        'city.required' => 'Please fill Town/City.',
        'phone.required' => 'Please fill Phone Number.',
        'phone.regex' => 'Phone number can only contain digits and the + symbol.',
        'phone.min' => 'Phone number must be at least 10 digits.',
    ];

    public function clearSavedBilling(): void
    {
        $this->hasSavedBilling = false;
        $this->first_name = '';
        $this->phone = '';
        $this->address = '';
        $this->city = '';
    }

    public function placeOrder(): mixed
    {
        $this->validate();

        $items = $this->cart->get();
        if (empty($items)) {
            return null;
        }

        $first = array_values($items)[0];
        $subtotal = $this->cart->subtotal();

        $product = Product::find($first['product_id']);

        if (! $product || ! $product->hasStock($first['quantity'])) {
            $this->addError('payment', 'Sorry, some items are out of stock.');

            return null;
        }

        // Save billing profile if requested
        if ($this->save_info) {
            BillingProfile::updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'name' => $this->first_name,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'city' => $this->city,
                ]
            );
        }

        $trx = DB::transaction(function () use ($first, $subtotal, $product) {
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'name' => $this->first_name,
                'phone' => $this->phone,
                'email' => Auth::user()->email,
                'address' => $this->address,
                'city' => $this->city,
                'post_code' => '-',
                'booking_trx_id' => Transaction::generateUniqueTrxId(),
                'proof' => null,
                'quantity' => $first['quantity'],
                'sub_total_amount' => $subtotal,
                'grand_total_amount' => $subtotal,
                'is_paid' => false,
                'product_id' => $first['product_id'],
            ]);

            $product->reduceStock($first['quantity']);

            return $transaction;
        });

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
                'finish' => route('payment.success', ['order_id' => $trx->booking_trx_id]),
                'unfinish' => route('payment.pending', ['order_id' => $trx->booking_trx_id]),
                'error' => route('payment.failed', ['order_id' => $trx->booking_trx_id]),
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

            $this->cart->clear();
            $this->dispatch('cart-updated');

            return redirect()->away($redirectUrl);
        } catch (\Exception $e) {
            $this->addError('payment', 'Midtrans Error: '.$e->getMessage());

            return null;
        }
    }

    public function render()
    {
        return view('livewire.pages.checkout', [
            'items' => $this->cart->get(),
            'subtotal' => $this->cart->subtotal(),
        ])->layout('components.layouts.app');
    }
}
