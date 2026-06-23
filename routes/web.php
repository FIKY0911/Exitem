<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Livewire\Pages\AboutPage;
use App\Livewire\Pages\CartPage;
use App\Livewire\Pages\CheckoutPage;
use App\Livewire\Pages\ContactPage;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Login;
use App\Livewire\Pages\MyAccount;
use App\Livewire\Pages\MyCollection;
use App\Livewire\Pages\MyOrders;
use App\Livewire\Pages\MyReviews;
use App\Livewire\Pages\ProductDetail;
use App\Livewire\Pages\Products;
use App\Livewire\Pages\SearchResults;
use App\Livewire\Pages\Signup;
use App\Livewire\Pages\WishlistPage;
use App\Models\Product;
use App\Models\Wishlist;
use App\Services\CartService;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/products', Products::class)->name('products');
Route::get('/search', SearchResults::class)->name('search');
Route::get('/login', Login::class)->name('login');
Route::get('/signup', Signup::class)->name('signup');
Route::middleware('auth')->group(function () {
    Route::get('/my-account', MyAccount::class)->name('my-account');
    Route::get('/my-orders', MyOrders::class)->name('my-orders');
    Route::get('/my-collection', MyCollection::class)->name('my-collection');
    Route::get('/my-reviews', MyReviews::class)->name('my-reviews');

    // Contact
    Route::get('/contact', ContactPage::class)->name('contact');

    // Wishlist
    Route::get('/wishlist', WishlistPage::class)->name('wishlist');
    Route::post('/wishlist/add/{product:slug}', function (Product $product) {
        Wishlist::firstOrCreate([
            'session_id' => session()->getId(),
            'product_id' => $product->id,
        ]);
        $count = Wishlist::where('session_id', session()->getId())->count();

        return request()->ajax()
            ? response()->json(['count' => $count])
            : back();
    })->name('wishlist.add');
    Route::post('/wishlist/move-all', function () {
        $service = app(CartService::class);
        $items = Wishlist::where('session_id', session()->getId())->get();
        foreach ($items as $item) {
            $service->add($item->product_id);
        }

        return redirect()->route('cart');
    })->name('wishlist.move-all');

    // Cart
    Route::get('/cart', CartPage::class)->name('cart');
    Route::post('/cart/add/{product:slug}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', CheckoutPage::class)->name('checkout');
});

Route::get('/about', AboutPage::class)->name('about');
Route::get('/product/{slug}', ProductDetail::class)->name('product.detail');

// Midtrans Payment Integration
Route::post('/midtrans/webhook', [PaymentController::class, 'webhook'])->name('payment.webhook');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/pending', [PaymentController::class, 'pending'])->name('payment.pending');
Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');
