<div class="flex flex-col min-h-screen">
    <livewire:components.navbar />

    <main class="max-w-[1170px] mx-auto px-5 py-10 flex-1">

        {{-- Header --}}
        <div class="mb-6">
            <h2 class="text-xl font-medium">Wishlist ({{ $wishlistItems->count() }})</h2>
        </div>

        {{-- Move All To Bag --}}
        @if($wishlistItems->count())
        <div class="bg-gray-50 rounded-lg px-6 py-4 flex items-center justify-between mb-8 border border-gray-200">
            <p class="text-sm text-gray-500">{{ $wishlistItems->count() }} item(s) in your wishlist</p>
            <form method="POST" action="{{ route('wishlist.move-all') }}">
                @csrf
                <button type="submit"
                        class="px-6 py-2.5 bg-[#DB4444] text-white rounded text-sm font-medium hover:bg-red-600 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Move All To Bag
                </button>
            </form>
        </div>
        @endif

        {{-- Category Filter --}}
        @if($categories->count())
        <div class="overflow-x-auto scrollbar-hide -mx-5 px-5 mb-6">
            <div class="flex gap-2 min-w-max pb-2">
                <button wire:click="filterByCategory('')"
                        class="px-4 py-2 rounded-lg text-xs font-semibold whitespace-nowrap transition-colors
                               {{ !$activeCategory ? 'bg-[#DB4444] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    All
                </button>
                @foreach($categories as $cat)
                <button wire:click="filterByCategory('{{ $cat->slug }}')"
                        class="px-4 py-2 rounded-lg text-xs font-semibold whitespace-nowrap transition-colors
                               {{ $activeCategory === $cat->slug ? 'bg-[#DB4444] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $cat->name }}
                </button>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Wishlist Grid --}}
        @if($wishlistItems->count())
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
            @foreach($wishlistItems as $item)
            @php $product = $item->product; @endphp
            <div class="relative" x-data="{ hovered: false }" @mouseenter="hovered = true" @mouseleave="hovered = false">
                {{-- Delete button --}}
                <button wire:click="remove({{ $product->id }})"
                        class="absolute top-3 right-3 z-10 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow hover:bg-red-500 hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>

                {{-- Image Container --}}
                <div class="bg-[#F5F5F5] rounded-md overflow-hidden relative" style="height:200px;">
                    <a href="{{ route('product.detail', $product->slug) }}">
                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-contain p-4">
                    </a>
                    {{-- Add To Cart overlay --}}
                    <div class="absolute bottom-0 left-0 right-0 bg-black text-white text-center py-2 text-sm font-medium transition-transform duration-200 cursor-pointer"
                         :class="hovered ? 'translate-y-0' : 'translate-y-full'"
                         onclick="addToCart('{{ route('cart.add', $product->slug) }}', this)">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Add To Cart
                    </div>
                </div>

                {{-- Info --}}
                <div class="mt-3">
                    <h3 class="font-medium text-sm truncate">{{ $product->name }}</h3>
                    <span class="text-[#DB4444] font-medium text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-20 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <p class="text-lg">Your wishlist is empty</p>
            <a href="{{ route('home') }}" class="mt-4 inline-block px-6 py-3 bg-[#DB4444] text-white rounded text-sm hover:bg-red-600 transition-colors">
                Continue Shopping
            </a>
        </div>
        @endif

        {{-- Just For You --}}
        @if($justForYou->count())
        <section>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <span class="w-5 h-10 bg-[#DB4444] rounded inline-block"></span>
                    <span class="text-[#DB4444] font-semibold">Just For You</span>
                </div>
                <a href="{{ route('home') }}"
                   class="px-6 py-3 border border-black rounded text-sm font-medium hover:bg-black hover:text-white transition-colors">
                    See All
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($justForYou as $p)
                <div class="relative" x-data="{ hovered: false }" @mouseenter="hovered = true" @mouseleave="hovered = false">
                    <div class="bg-[#F5F5F5] rounded-md overflow-hidden relative" style="height:200px;">
                        <a href="{{ route('product.detail', $p->slug) }}">
                            <img src="{{ asset('storage/' . $p->thumbnail) }}" alt="{{ $p->name }}"
                                 class="w-full h-full object-contain p-4">
                        </a>
                        <div class="absolute bottom-0 left-0 right-0 bg-black text-white text-center py-2 text-sm font-medium transition-transform duration-200 cursor-pointer"
                             :class="hovered ? 'translate-y-0' : 'translate-y-full'"
                             onclick="addToCart('{{ route('cart.add', $p->slug) }}', this)">
                            Add To Cart
                        </div>
                    </div>
                    <div class="mt-3">
                        <h3 class="text-sm font-medium truncate">{{ $p->name }}</h3>
                        <span class="text-[#DB4444] text-sm font-medium">Rp {{ number_format($p->price, 0, ',', '.') }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

    </main>

    <livewire:components.footer />
</div>