<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Product;

class ProductDetail extends Component
{
    public Product $product;

    public $selectedColor = null;

    public function mount($slug)
    {
        $this->product = Product::with(['images', 'relatedProducts', 'reviews'])
                                ->where('slug', $slug)
                                ->firstOrFail();
    }

    public function buyNow($quantity)
    {
        $this->validate(['selectedColor' => 'required']);

        app(\App\Services\CartService::class)->add($this->product->id, $quantity);
        return redirect()->route('cart');
    }

    public function addToCart($quantity = 1)
    {
        app(\App\Services\CartService::class)->add($this->product->id, $quantity);
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('livewire.pages.product-detail')
                ->layout('components.layouts.app');
    }
}
