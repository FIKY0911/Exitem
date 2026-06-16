<?php

namespace App\Livewire\Pages;

use App\Models\Transaction;
use App\Services\CartService;
use Livewire\Component;

class CheckoutPage extends Component
{
    // Billing fields
    public string $first_name = '';
    public string $address    = '';
    public string $city       = '';
    public string $phone      = '';
    public bool   $save_info  = false;
    public string $payment    = '';

    protected CartService $cart;

    public function boot(CartService $cart): void
    {
        $this->cart = $cart;
    }

    protected function rules(): array
    {
        return [
            'first_name' => 'required|string|min:2',
            'address'    => 'required|string',
            'city'       => 'required|string',
            'phone'      => ['required', 'regex:/^[0-9]+$/'],
            'payment'    => 'required|in:bank_transfer,cod,qris',
        ];
    }

    protected $messages = [
        'first_name.required' => 'Please fill First Name.',
        'address.required'    => 'Please fill Street Address.',
        'city.required'       => 'Please fill Town/City.',
        'phone.required'      => 'Please fill Phone Number.',
        'phone.regex'         => 'Phone number must contain only digits.',
        'payment.required'    => 'Please select a payment method.',
    ];

    public function placeOrder(): mixed
    {
        $this->validate();

        $items = $this->cart->get();
        if (empty($items)) return null;

        $first    = array_values($items)[0];
        $subtotal = $this->cart->subtotal();

        Transaction::create([
            'name'               => $this->first_name,
            'phone'              => $this->phone,
            'email'              => 'guest@exitem.com',
            'address'            => $this->address,
            'city'               => $this->city,
            'post_code'          => '-',
            'booking_trx_id'     => Transaction::generateUniqueTrxId(),
            'proof'              => '-',
            'quantity'           => $first['quantity'],
            'sub_total_amount'   => $subtotal,
            'grand_total_amount' => $subtotal,
            'is_paid'            => false,
            'product_id'         => $first['product_id'],
        ]);

        $this->cart->clear();
        $this->dispatch('cart-updated');

        session()->flash('order_success', 'Order placed successfully!');
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.pages.checkout', [
            'items'    => $this->cart->get(),
            'subtotal' => $this->cart->subtotal(),
        ])->layout('components.layouts.app');
    }
}
