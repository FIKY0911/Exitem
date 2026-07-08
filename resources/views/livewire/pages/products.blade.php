<div class="min-h-screen flex flex-col">
    <livewire:components.navbar />
    
    <div class="flex-grow max-w-[1170px] mx-auto px-5 sm:px-10 lg:px-16 py-12 w-full">
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-4">Semua Produk</h1>
            
            <p class="text-gray-600 mt-4">Menampilkan semua produk - {{ $products->total() }} produk</p>
        </div>

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 mb-8">
                @foreach($products as $product)
                    <livewire:components.product-card :product="$product" :key="'product-'.$product->id" />
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Produk tidak ditemukan</h3>
                <p class="text-gray-500 mb-4">Kami tidak dapat menemukan produk saat ini.</p>
            </div>
        @endif
    </div>

    <livewire:components.footer />
</div>
