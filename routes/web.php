<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\AboutPage;
use App\Livewire\Pages\CartPage;
use App\Livewire\Pages\CheckoutPage;
use App\Livewire\Pages\ContactPage;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\ProductDetail;
use App\Livewire\Pages\WishlistPage;

use App\Livewire\Pages\Login;
use App\Livewire\Pages\Signup;
use App\Livewire\Pages\MyOrders;
use App\Livewire\Pages\MyCollection;

use App\Livewire\Pages\MyAccount;
use App\Livewire\Pages\SearchResults;
use App\Livewire\Pages\Products;

Route::get('/', Home::class)->name('home');
Route::get('/products', Products::class)->name('products');
Route::get('/search', SearchResults::class)->name('search');
Route::get('/login', Login::class)->name('login');
Route::get('/signup', Signup::class)->name('signup');

Route::middleware('auth')->group(function () {
    Route::get('/my-account', MyAccount::class)->name('my-account');
    Route::get('/my-orders', MyOrders::class)->name('my-orders');
    Route::get('/my-collection', MyCollection::class)->name('my-collection');
    Route::get('/my-reviews', \App\Livewire\Pages\MyReviews::class)->name('my-reviews');

    // Contact
    Route::get('/contact', ContactPage::class)->name('contact');

    // Wishlist
    Route::get('/wishlist', WishlistPage::class)->name('wishlist');
    Route::post('/wishlist/add/{product:slug}', function (\App\Models\Product $product) {
        \App\Models\Wishlist::firstOrCreate([
            'session_id' => session()->getId(),
            'product_id' => $product->id,
        ]);
        $count = \App\Models\Wishlist::where('session_id', session()->getId())->count();
        return request()->ajax()
            ? response()->json(['count' => $count])
            : back();
    })->name('wishlist.add');
    Route::post('/wishlist/move-all', function () {
        $service = app(\App\Services\CartService::class);
        $items = \App\Models\Wishlist::where('session_id', session()->getId())->get();
        foreach ($items as $item) {
            $service->add($item->product_id);
        }
        return redirect()->route('cart');
    })->name('wishlist.move-all');

    // Cart
    Route::get('/cart', CartPage::class)->name('cart');
    Route::post('/cart/add/{product:slug}',    [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{productId}',    [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{productId}',    [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

    // Checkout & Order
    Route::get('/checkout', CheckoutPage::class)->name('checkout');
    Route::post('/order/begin/{product:slug}', [OrderController::class, 'saveOrder'])->name('front.save_order');
    Route::get('/order/booking/', [OrderController::class, 'booking'])->name('front.booking');
    Route::get('/order/booking/customer-data', [OrderController::class, 'customerData'])->name('front.customer_data');
    Route::post('/order/booking/customer-data/save', [OrderController::class, 'saveCustomerData'])->name('front.save_customer_data');
    Route::get('/order/payment', [OrderController::class, 'payment'])->name('front.payment');
    Route::post('/order/payment/confirm', [OrderController::class, 'paymentConfirm'])->name('front.payment_confirm');
    Route::get('/order/finished/{productTransaction:id}', [OrderController::class, 'orderFinished'])->name('front.order_finished');
});

Route::get('/about', AboutPage::class)->name('about');
Route::get('/product/{slug}', ProductDetail::class)->name('product.detail');
