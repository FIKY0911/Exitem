<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ProductCard extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }
    
    public function addToCart()
    {
        app(\App\Services\CartService::class)->add($this->product->id);
        $this->dispatch('cart-updated');
    }

    public function addToWishlist()
    {
        \App\Models\Wishlist::firstOrCreate([
            'session_id' => session()->getId(),
            'product_id' => $this->product->id,
        ]);
        $this->dispatch('wishlist-updated');
    }

    public function render()
    {
        return view('livewire.components.product-card');
    }
}
