<!-- Product Card Component with Tailwind CSS -->
<div class="relative rounded-lg overflow-hidden bg-white flex flex-col border border-gray-200 shadow-sm transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-xl group">
    <!-- Thumbnail Area -->
    <div class="bg-gray-100 h-56 relative overflow-hidden rounded-t-lg">
        <!-- Discount/New Badge -->
        @if($product->discount_percentage ?? false)
            <div class="absolute top-3 left-3 bg-[#DB4444] text-white px-2.5 py-1 rounded text-xs font-semibold z-10">
                -{{ $product->discount_percentage }}%
            </div>
        @else
            <div class="absolute top-3 left-3 bg-green-500 text-white px-2.5 py-1 rounded text-xs font-semibold z-10">
                NEW
            </div>
        @endif

        <!-- Action Buttons (Wishlist & View) -->
        <div class="absolute top-2.5 right-2.5 flex flex-col gap-1.5 opacity-0 translate-x-2 transition-all duration-200 ease-in-out group-hover:opacity-100 group-hover:translate-x-0 z-10">
            <button onclick="toggleWishlist('{{ route('wishlist.toggle', $product->slug) }}', this)" 
                    class="bg-white rounded-full w-9 h-9 flex items-center justify-center shadow-sm transition-colors duration-200 text-gray-700 hover:bg-[#DB4444] hover:text-white">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            </button>
            <button onclick="window.location='{{ route('product.detail', $product->slug) }}'" 
                    class="bg-white rounded-full w-9 h-9 flex items-center justify-center shadow-sm transition-colors duration-200 text-gray-700 hover:bg-[#DB4444] hover:text-white">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </button>
        </div>

        <!-- Product Image -->
        <a href="{{ route('product.detail', $product->slug) }}" class="block w-full h-full relative z-0">
            <img src="{{ asset('storage/' . $product->thumbnail) }}" 
                 alt="{{ $product->name }}"
                 class="w-full h-full object-contain p-4 box-border transition-transform duration-300 ease-in-out group-hover:scale-105">
        </a>

        <!-- Add to Cart Button -->
        <div onclick="toggleCart('{{ route('cart.toggle', $product->slug) }}', this)"
             class="absolute bottom-0 left-0 w-full bg-gray-900 text-white text-center py-3 cursor-pointer font-medium text-sm tracking-wide translate-y-full transition-transform duration-300 ease-in-out group-hover:translate-y-0 z-10">
            Add To Cart
        </div>
    </div>

    <!-- Product Info -->
    <a href="{{ route('product.detail', $product->slug) }}" class="block px-3 pt-3 pb-4">
        <h3 class="font-medium text-sm mb-1 truncate text-gray-800">{{ $product->name }}</h3>
        <span class="text-[#DB4444] font-semibold text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
        <div class="flex items-center gap-1 mt-1">
            <div class="flex text-[#FFAD33]">
                @for($i=1; $i<=5; $i++)
                    <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path></svg>
                @endfor
            </div>
            <span class="text-[11px] text-gray-500">({{ $product->stock }})</span>
        </div>
    </a>
</div>
