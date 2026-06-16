<div>
    <livewire:components.navbar />

    <main class="container-max">
        <!-- Hero Section -->
        <livewire:components.hero-banner :categories="$this->categories" />

        <!-- Category Highlight -->
        <section class="section-spacing">
            <div class="mb-8">
                <span class="red-rect"></span><span class="text-[var(--primary-red)] font-semibold">Categories</span>
                <div class="flex items-center gap-4 sm:gap-16 mb-8">
            <h2 class="text-2xl sm:text-3xl font-semibold tracking-wider">Browse By Category</h2>
        </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-6 gap-5">
                @foreach($this->categories as $category)
                    <div class="cat-box">
                        <x-dynamic-component :component="$category->icon ?? 'heroicon-o-cube'" class="w-8 h-8 mb-4" />
                        <span>{{ $category->name }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <hr class="border-gray-200">

        <!-- Best Selling -->
        <section class="section-spacing">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 sm:gap-0 mb-8 sm:mb-10">
                <div>
                    <span class="red-rect"></span><span class="text-[var(--primary-red)] font-semibold">This Month</span>
                    <h2 class="text-2xl sm:text-3xl font-semibold tracking-wider mt-4">Best Selling Products</h2>
                </div>
                <button class="bg-[var(--primary-red)] text-white px-8 sm:px-10 py-3 rounded hover:bg-red-600 transition-colors w-full sm:w-auto">View All</button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($this->bestSellingProducts as $product)
                    <livewire:components.product-card :product="$product" :key="'best-'.$product->id" />
                @endforeach
            </div>
        </section>

        <!-- Explore Products -->
        <section class="section-spacing">
            <div class="mb-8">
                <span class="red-rect"></span><span class="text-[var(--primary-red)] font-semibold">Our Products</span>
                <h2 class="section-title text-3xl font-semibold mt-4">Explore Our Products</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($this->exploreProducts as $product)
                    <livewire:components.product-card :product="$product" :key="'explore-'.$product->id" />
                @endforeach
            </div>
            <div class="text-center mt-10">
                <button class="btn-red px-10 py-3">View All Products</button>
            </div>
        </section>

        <!-- New Arrivals -->
        <section class="section-spacing">
            <div class="mb-8">
                <span class="red-rect"></span><span class="text-[var(--primary-red)] font-semibold">Featured</span>
                <div class="flex items-center gap-4 sm:gap-16 mb-8">
            <h2 class="text-2xl sm:text-3xl font-semibold tracking-wider">New Arrival</h2>
        </div>
            </div>
            <div class="new-arrival-grid">
                @if($this->newArrivals->count() > 0)
                <div class="new-arrival-card main-poster">
                    <img src="{{ asset('storage/' . $this->newArrivals[0]->thumbnail) }}" class="bg-image" alt="{{ $this->newArrivals[0]->name }}">
                    <div class="content">
                        <h3>{{ $this->newArrivals[0]->name }}</h3>
                        <p>{{ Str::limit($this->newArrivals[0]->about, 50) }}</p>
                        <a href="#">Shop Now</a>
                    </div>
                </div>
                @endif
                
                <div class="flex flex-col gap-8">
                    @if($this->newArrivals->count() > 1)
                    <div class="new-arrival-card flex-1 min-h-[284px]">
                        <img src="{{ asset('storage/' . $this->newArrivals[1]->thumbnail) }}" class="bg-image" alt="{{ $this->newArrivals[1]->name }}">
                        <div class="content">
                            <h3>{{ $this->newArrivals[1]->name }}</h3>
                            <p>{{ Str::limit($this->newArrivals[1]->about, 50) }}</p>
                            <a href="#">Shop Now</a>
                        </div>
                    </div>
                    @endif
                    <div class="grid grid-cols-2 gap-8 flex-1">
                        @if($this->newArrivals->count() > 2)
                        <div class="new-arrival-card">
                            <img src="{{ asset('storage/' . $this->newArrivals[2]->thumbnail) }}" class="bg-image" alt="{{ $this->newArrivals[2]->name }}">
                            <div class="content">
                                <h3 class="text-lg">{{ $this->newArrivals[2]->name }}</h3>
                                <a href="#" class="text-sm">Shop Now</a>
                            </div>
                        </div>
                        @endif
                        @if($this->newArrivals->count() > 3)
                        <div class="new-arrival-card">
                            <img src="{{ asset('storage/' . $this->newArrivals[3]->thumbnail) }}" class="bg-image" alt="{{ $this->newArrivals[3]->name }}">
                            <div class="content">
                                <h3 class="text-lg">{{ $this->newArrivals[3]->name }}</h3>
                                <a href="#" class="text-sm">Shop Now</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Services -->
        <section class="section-spacing pt-4 pb-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-center">
                <div class="service-item">
                    <div class="service-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="font-semibold text-lg mb-2">FREE AND FAST DELIVERY</h4>
                    <p class="text-sm text-[var(--text-gray)]">Free delivery for all orders over $140</p>
                </div>
                <div class="service-item">
                    <div class="service-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h4 class="font-semibold text-lg mb-2">24/7 CUSTOMER SERVICE</h4>
                    <p class="text-sm text-[var(--text-gray)]">Friendly 24/7 customer support</p>
                </div>
                <div class="service-item">
                    <div class="service-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="font-semibold text-lg mb-2">MONEY BACK GUARANTEE</h4>
                    <p class="text-sm text-[var(--text-gray)]">We return money within 30 days</p>
                </div>
            </div>
        </section>
    </main>

    <livewire:components.footer />
</div>
