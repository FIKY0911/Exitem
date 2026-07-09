<?php

namespace App\Livewire\Pages;

use App\Services\CartService;
use Livewire\Component;

class CartPage extends Component
{
    public function render()
    {
        $cart     = app(CartService::class);
        $items    = $cart->get();
        $subtotal = $cart->subtotal();

        return view('livewire.pages.cart', compact('items', 'subtotal'))
            ->layout('components.layouts.app');
    }
}
