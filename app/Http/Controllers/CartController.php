<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected CartService $cart) {}

    public function add(Request $request, Product $product)
    {
        $this->cart->add($product->id, max(1, (int) $request->quantity));
        $count = $this->cart->count();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['count' => $count, 'name' => $product->name]);
        }

        return back()->with('cart_added', $product->name);
    }

    public function update(Request $request, int $productId)
    {
        $qty = (int) $request->quantity;
        $qty <= 0
            ? $this->cart->remove($productId)
            : $this->cart->updateQuantity($productId, $qty);

        return back();
    }

    public function remove(int $productId)
    {
        $this->cart->remove($productId);
        return back();
    }
}
