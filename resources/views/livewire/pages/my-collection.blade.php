<div class="flex flex-col min-h-screen">
    <livewire:components.navbar />

    <main class="container-max py-10 flex-1">
        <div class="mb-8">
            <span class="red-rect"></span><span class="text-[var(--primary-red)] font-semibold">Account</span>
            <h2 class="text-3xl font-semibold tracking-wider mt-4">My Collection</h2>
        </div>

        @if($collection->count())
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                @foreach($collection as $item)
                    @php $product = $item->product; @endphp
                    <div class="product-card group relative">
                        {{-- Remove button --}}
                        <button wire:click="removeFromCollection({{ $item->id }})"
                                class="absolute top-3 right-3 z-10 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-red-500 hover:text-white transition-all transform hover:scale-110">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        <div class="thumbnail-area">
                            <a href="{{ route('product.detail', $product->slug) }}">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">
                            </a>
                            <div class="add-to-cart-btn" onclick="addToCart('{{ route('cart.add', $product->slug) }}', this)">
                                Add To Cart
                            </div>
                        </div>
                        <div class="p-4 bg-white">
                            <h3 class="font-medium text-sm text-gray-800 truncate">{{ $product->name }}</h3>
                            <p class="text-[var(--primary-red)] font-semibold mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <p class="text-lg">Your collection is empty</p>
                <a href="{{ route('home') }}" class="mt-4 inline-block px-6 py-3 bg-[#DB4444] text-white rounded text-sm hover:bg-red-600 transition-colors">
                    Find Products
                </a>
            </div>
        @endif
    </main>

    <livewire:components.footer />
</div>
