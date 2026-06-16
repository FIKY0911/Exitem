<?php

namespace App\Livewire\Pages;

use App\Models\Product;
use App\Models\Wishlist;
use Livewire\Component;

class WishlistPage extends Component
{
    public function getSessionId(): string
    {
        return session()->getId();
    }

    public function remove(int $productId): void
    {
        Wishlist::where('session_id', $this->getSessionId())
                ->where('product_id', $productId)
                ->delete();
    }

    public function moveAllToBag(): void
    {
        $cartService = app(\App\Services\CartService::class);
        $items = Wishlist::with('product')
            ->where('session_id', $this->getSessionId())
            ->get();

        foreach ($items as $item) {
            $cartService->add($item->product_id);
        }

        $this->dispatch('cart-updated');
        $this->redirect(route('cart'));
    }

    public function render()
    {
        $wishlistItems = Wishlist::with('product.images')
            ->where('session_id', $this->getSessionId())
            ->get();

        $justForYou = Product::with('images')
            ->whereNotIn('id', $wishlistItems->pluck('product_id'))
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('livewire.pages.wishlist', compact('wishlistItems', 'justForYou'))
            ->layout('components.layouts.app');
    }
}
