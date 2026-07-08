<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    const SESSION_KEY = 'cart';

    public function get(): array
    {
        return session(self::SESSION_KEY, []);
    }

    public function add(int $productId, int $quantity = 1): void
    {
        $cart = $this->get();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $product = Product::findOrFail($productId);
            $cart[$productId] = [
                'product_id' => $productId,
                'name'       => $product->name,
                'price'      => $product->price,
                'thumbnail'  => $product->thumbnail,
                'slug'       => $product->slug,
                'quantity'   => $quantity,
            ];
        }

        session([self::SESSION_KEY => $cart]);
    }

    public function remove(int $productId): void
    {
        $cart = $this->get();
        unset($cart[$productId]);
        session([self::SESSION_KEY => $cart]);
    }

    public function updateQuantity(int $productId, int $quantity): void
    {
        $cart = $this->get();
        if (isset($cart[$productId])) {
            if ($quantity < 1) {
                $this->remove($productId);
                return;
            }
            $cart[$productId]['quantity'] = $quantity;
            session([self::SESSION_KEY => $cart]);
        }
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    public function items(): array
    {
        return array_map(function($item) {
            return [
                'id' => $item['product_id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'thumbnail' => $item['thumbnail'],
                'slug' => $item['slug'],
                'quantity' => $item['quantity'],
            ];
        }, $this->get());
    }

    public function count(): int
    {
        return array_sum(array_column($this->get(), 'quantity'));
    }

    public function subtotal(): int
    {
        return array_sum(array_map(
            fn ($item) => $item['price'] * $item['quantity'],
            $this->get()
        ));
    }
}
