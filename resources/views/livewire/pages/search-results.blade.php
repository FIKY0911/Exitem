<div class="min-h-screen flex flex-col">
    <livewire:components.navbar />
    
    <div class="flex-grow container-max px-6 sm:px-10 lg:px-16 py-12 w-full">
        <h1 class="text-3xl font-bold mb-2">Search Results</h1>
        <p class="text-gray-600 mb-8">
            @if($query)
                {{ $products->total() ?? 0 }} results found for "{{ $query }}"
            @else
                Please enter a search term
            @endif
        </p>

        @if($products && $products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <livewire:components.product-card :product="$product" :key="'search-'.$product->id" />
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @elseif($query)
            <div class="text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No products found</h3>
                <p class="text-gray-500">Try searching with different keywords</p>
            </div>
        @endif
    </div>

    <livewire:components.footer />
</div>
