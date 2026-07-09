<?php

namespace App\Livewire\Pages;

use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Livewire\Component;

class WishlistPage extends Component
{
    public string $activeCategory = '';

    public function getSessionId(): string
    {
        return session()->getId();
    }

    public function filterByCategory(string $slug): void
    {
        $this->activeCategory = $this->activeCategory === $slug ? '' : $slug;
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
        $categories = Category::whereHas('products', function ($q) {
            $q->whereIn('id', Wishlist::where('session_id', $this->getSessionId())->pluck('product_id'));
        })->get();

        $wishlistItems = Wishlist::with('product.images', 'product.category')
            ->where('session_id', $this->getSessionId())
            ->when($this->activeCategory, function ($query) {
                $query->whereHas('product', function ($q) {
                    $q->whereHas('category', function ($cq) {
                        $cq->where('slug', $this->activeCategory);
                    });
                });
            })
            ->get();

        $justForYou = Product::with('images')
            ->whereNotIn('id', Wishlist::where('session_id', $this->getSessionId())->pluck('product_id'))
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('livewire.pages.wishlist', compact('wishlistItems', 'justForYou', 'categories'))
            ->layout('components.layouts.app');
    }
}
