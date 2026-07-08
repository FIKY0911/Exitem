<div class="flex flex-col min-h-screen" style="background: #faf8f5;">
    <livewire:components.navbar />

    <main style="padding: 3.5rem 0; flex: 1;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">

            <p style="font-size: 11px; letter-spacing: 0.15em; text-transform: uppercase; color: #9ca3af; margin-bottom: 2.5rem; font-weight: 600;">
                Home <span style="margin: 0 0.5rem; color: #d1d5db;">/</span> Account <span style="margin: 0 0.5rem; color: #d1d5db;">/</span> <span style="color: #DB4444;">My Collection</span>
            </p>

            <div style="display: flex; gap: 2rem; align-items: flex-start;">
                <x-account-sidebar />

                <div style="flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 1.5rem;">
                    <div style="background: #fff; border-radius: 1.25rem; border: 1px solid #e5e7eb; box-shadow: 0 2px 20px rgba(0,0,0,0.05); overflow: hidden;">
                        <div style="height: 5px; background: linear-gradient(90deg, #DB4444, #e8704a);"></div>
                        <div style="padding: 2.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem;">
                                <div style="width: 4px; height: 24px; border-radius: 9999px; background: #DB4444;"></div>
                                <h2 style="font-size: 1.125rem; font-weight: 800; color: #111827;">My Collection</h2>
                            </div>

                            @if($collection->count())
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                    @foreach($collection as $item)
                                        @php $product = $item->product; @endphp
                                        <div class="relative rounded-lg overflow-hidden bg-white flex flex-col border border-gray-200 shadow-sm transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-xl group">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <livewire:components.footer />
</div>
