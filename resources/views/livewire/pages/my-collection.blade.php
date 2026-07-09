<div class="flex flex-col min-h-screen bg-[#faf8f5]">
    <livewire:components.navbar />

    <main class="py-10 sm:py-14 flex-1">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-8">

            <p class="text-[11px] tracking-[0.15em] uppercase text-gray-400 mb-6 sm:mb-10 font-semibold">
                Home <span class="mx-1.5 text-gray-300">/</span> Account <span class="mx-1.5 text-gray-300">/</span> <span class="text-[#DB4444]">My Collection</span>
            </p>

            <div class="flex flex-col lg:flex-row gap-6 lg:gap-8 items-start">
                <x-account-sidebar />

                <div class="flex-1 min-w-0 flex flex-col gap-4 sm:gap-6 w-full">
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-[0_2px_20px_rgba(0,0,0,0.05)] overflow-hidden">
                        <div class="h-[5px] bg-gradient-to-r from-[#DB4444] to-[#e8704a]"></div>
                        <div class="p-5 sm:p-8 lg:p-10">
                            <div class="flex items-center gap-3 mb-6 sm:mb-8">
                                <div class="w-1 h-6 rounded-full bg-[#DB4444]"></div>
                                <h2 class="text-base sm:text-lg font-extrabold text-gray-900">My Collection</h2>
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
