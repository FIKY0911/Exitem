<div class="product-card group">
    <div class="thumbnail-area">
        @if($product->discount_percentage ?? false)
            <div class="discount-badge">-{{ $product->discount_percentage }}%</div>
        @else
            <div class="discount-badge bg-green-500">NEW</div>
        @endif

        <div class="icons-top-right">
            <button onclick="addToWishlist('{{ route('wishlist.add', $product->slug) }}', this)">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </button>
            <button onclick="window.location='{{ route('product.detail', $product->slug) }}'">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </button>
        </div>

        <a href="{{ route('product.detail', $product->slug) }}" class="block">
            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
        </a>

        <div class="add-to-cart-btn"
             onclick="addToCart('{{ route('cart.add', $product->slug) }}', this)"
             style="cursor:pointer">
            Add To Cart
        </div>
    </div>

    <a href="{{ route('product.detail', $product->slug) }}" class="block px-3 pt-3 pb-4">
        <h3 class="font-medium text-sm mb-1 truncate" style="color:#222;">{{ $product->name }}</h3>
        <span class="text-[var(--primary-red)] font-semibold text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
        <div class="flex items-center gap-1 mt-1">
            <div class="flex" style="color:#FFAD33;">
                @for($i=1; $i<=5; $i++)
                    <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                @endfor
            </div>
            <span style="font-size:11px; color:#999;">({{ $product->stock }})</span>
        </div>
    </a>
</div>
