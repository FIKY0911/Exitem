<div>
    <livewire:components.navbar />

    <main class="max-w-[1170px] mx-auto px-5 py-10">

        {{-- Breadcrumb --}}
        <nav class="text-sm mb-8 flex items-center gap-2" style="color:#7D8184">
            <a href="{{ route('home') }}" class="hover:text-black">Home</a>
            <span>/</span>
            <a href="#" class="hover:text-black">{{ $product->category->name ?? 'Category' }}</a>
            <span>/</span>
            <span class="text-black font-medium">{{ $product->name }}</span>
        </nav>

        {{-- Main Product Section --}}
        <div class="flex flex-col lg:flex-row gap-[70px] mb-16"
             x-data="{
                activeImage: '{{ asset('storage/' . ($product->images->where('is_primary', true)->first()?->url ?? $product->thumbnail)) }}',
                quantity: 1,
                incQty() { this.quantity++ },
                decQty() { if (this.quantity > 1) this.quantity-- }
             }">

            {{-- Gallery --}}
            <div class="flex gap-4 shrink-0">
                {{-- Thumbnails --}}
                <div class="flex flex-col gap-4">
                    @php
                        $allImages = $product->images->count()
                            ? $product->images
                            : collect([['url' => $product->thumbnail, 'is_primary' => true]]);
                    @endphp
                    @foreach($allImages as $img)
                        @php $imgUrl = is_array($img) ? $img['url'] : $img->url; @endphp
                        <button
                            class="w-[170px] h-[138px] rounded flex items-center justify-center transition-all border-2"
                            :class="activeImage === '{{ asset('storage/' . $imgUrl) }}' ? 'border-black' : 'border-transparent'"
                            @click="activeImage = '{{ asset('storage/' . $imgUrl) }}'"
                            style="background:#F5F5F5">
                            <img src="{{ asset('storage/' . $imgUrl) }}" alt="thumb" class="max-h-full max-w-full object-contain p-2">
                        </button>
                    @endforeach
                </div>

                {{-- Main Image --}}
                <div class="w-[500px] h-[600px] rounded flex items-center justify-center" style="background:#F5F5F5">
                    <img :src="activeImage" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain p-6">
                </div>
            </div>

            {{-- Product Info --}}
            <div class="flex-1 flex flex-col gap-4">
                <h1 class="text-2xl font-semibold">{{ $product->name }}</h1>

                {{-- Rating & Stock --}}
                <div class="flex items-center gap-4">
                    <div class="flex">
                        @php $avg = $product->reviews->avg('rating') ?: 0; @endphp
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= round($avg) ? 'text-[#FFAD33]' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        @endfor
                    </div>
                    <span class="text-sm" style="color:#7D8184">({{ $product->reviews->count() }} Reviews)</span>
                    <span class="text-sm" style="color:#00FF66">| {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                </div>

                {{-- Price --}}
                <div class="text-2xl font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</div>

                <hr style="border-color:rgba(0,0,0,0.3)">

                {{-- Description --}}
                <p class="text-sm leading-relaxed" style="color:#7D8184; line-height:1.5">{{ $product->about }}</p>

                <hr style="border-color:rgba(0,0,0,0.3)">

                {{-- Colours --}}
                <div class="flex items-center gap-4">
                    <span class="font-medium">Colours:</span>
                    <div class="flex gap-2">
                        @php $colors = $product->colors ?? [['value'=>'#DB4444'],['value'=>'#1D6F42'],['value'=>'#000000']]; @endphp
                        @foreach($colors as $c)
                            @php $hex = is_array($c) ? $c['value'] : $c; @endphp
                            <label class="cursor-pointer">
                                <input type="radio" name="color" value="{{ $hex }}" wire:model="selectedColor" class="hidden">
                                <span class="block w-5 h-5 rounded-full transition-all"
                                      style="background:{{ $hex }}; {{ $selectedColor === $hex ? 'box-shadow: 0 0 0 2px white inset, 0 0 0 3px black;' : '' }}">
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Quantity + Buy Now + Wishlist --}}
                <div style="display:flex; align-items:center; gap:12px; margin-top:8px; flex-wrap:wrap;">
                    {{-- Quantity Selector --}}
                    <div class="flex items-center border rounded-sm overflow-hidden" style="border-color:rgba(0,0,0,0.3)">
                        <button type="button" @click="decQty" title="Decrease quantity"
                                class="w-10 h-11 text-xl font-light hover:bg-gray-100 transition-colors">−</button>
                        <input type="number" x-model="quantity" min="1" :max="{{ $product->stock }}"
                               class="w-20 h-11 text-center font-semibold text-base border-x focus:outline-none"
                               style="border-color:rgba(0,0,0,0.3); -webkit-appearance:none; -moz-appearance:textfield;">
                        <button type="button" @click="if(quantity < {{ $product->stock }}) incQty()" title="Increase quantity"
                                class="w-10 h-11 text-xl font-light text-white transition-colors"
                                style="background:#DB4444">+</button>
                    </div>

                    {{-- Buy Now --}}
                    <form method="POST" action="{{ route('cart.add', $product->slug) }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="quantity" :value="quantity">
                        <button type="submit" title="Buy Now — proceed to checkout"
                                @if($product->stock <= 0) disabled @endif
                                style="height:44px; padding:0 28px; border-radius:4px; background:{{ $product->stock > 0 ? '#DB4444' : '#999' }}; color:#fff; border:none; font-weight:500; cursor:{{ $product->stock > 0 ? 'pointer' : 'not-allowed' }}; white-space:nowrap;">
                            {{ $product->stock > 0 ? 'Buy Now' : 'Out of Stock' }}
                        </button>
                    </form>

                    {{-- Add to Cart --}}
                    <form method="POST" action="{{ route('cart.add', $product->slug) }}" style="display:inline;">
                        @csrf
                        <input type="hidden" name="quantity" :value="quantity">
                        <button type="submit" title="Add to Cart"
                                @if($product->stock <= 0) disabled @endif
                                style="width:44px; height:44px; border-radius:4px; border:1px solid #000; background:{{ $product->stock > 0 ? '#fff' : '#eee' }}; cursor:{{ $product->stock > 0 ? 'pointer' : 'not-allowed' }}; display:inline-flex; align-items:center; justify-content:center;">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                    </form>

                    {{-- Wishlist --}}
                    <button type="button" title="Add to Wishlist"
                            onclick="addToWishlist('{{ route('wishlist.add', $product->slug) }}', this)"
                            class="w-11 h-11 border rounded flex items-center justify-center hover:bg-red-50 transition-colors"
                            style="border-color:rgba(0,0,0,0.3)">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>

                {{-- Delivery Info --}}
                <div class="border rounded mt-4" style="border-color:rgba(0,0,0,0.3)">
                    <div class="flex items-center gap-4 p-4 border-b" style="border-color:rgba(0,0,0,0.3)">
                        <svg class="w-10 h-10 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        <div>
                            <div class="font-medium text-base">Free Delivery</div>
                            <div class="text-xs underline mt-1" style="color:#7D8184">Enter your postal code for Delivery Availability</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4">
                        <svg class="w-10 h-10 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        <div>
                            <div class="font-medium text-base">Return Delivery</div>
                            <div class="text-xs underline mt-1" style="color:#7D8184">Free 30 Days Delivery Returns.</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Product Reviews Section --}}
        <livewire:components.product-reviews :productId="$product->id" />

        {{-- Related Items --}}
        @if($product->relatedProducts->count())
        <section class="py-20">
            <div class="mb-8">
                <div class="inline-flex items-center">
                    <span class="inline-block w-5 h-10 bg-[#DB4444] rounded mr-4 align-middle"></span>
                    <span class="text-[#DB4444] font-semibold">Related Items</span>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($product->relatedProducts as $related)
                    <livewire:components.product-card :product="$related" :key="'related-'.$related->id" />
                @endforeach
            </div>
        </section>
        @endif

    </main>

    <livewire:components.footer />
</div>

<style>
    /* Hide number input spinner */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; }
    input[type=number] { -moz-appearance: textfield; }
</style>
