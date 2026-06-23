<div>
    <livewire:components.navbar />

    <main class="container-max" x-data x-on:scroll-to-products.window="document.getElementById('product-display').scrollIntoView({behavior: 'smooth'})">
        <!-- Hero Section -->
        <livewire:components.hero-banner :categories="$this->categories" />

        <!-- Category Highlight -->
        <section class="section-spacing">
            <div class="mb-8">
                <span class="red-rect"></span><span class="text-[var(--primary-red)] font-semibold">Kategori</span>
                <div class="flex items-center justify-between gap-4 sm:gap-16 mb-8">
                    <h2 class="text-2xl sm:text-3xl font-semibold tracking-wider">Jelajahi Berdasarkan Kategori</h2>
                    @if($selectedCategorySlug)
                        <button wire:click="selectCategory(null)" class="text-sm font-medium text-[var(--primary-red)] hover:underline flex items-center gap-1">
                            <span>Hapus Filter</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    @endif
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-6 gap-5">
                @foreach($this->categories as $category)
                    <div wire:click="selectCategory('{{ $category->slug }}')" 
                         class="cat-box cursor-pointer transition-all duration-300 {{ $selectedCategorySlug === $category->slug ? 'bg-[var(--primary-red)] text-white shadow-lg' : 'hover:border-[var(--primary-red)] hover:text-[var(--primary-red)]' }}">
                        <x-dynamic-component :component="$category->icon ?? 'heroicon-o-cube'" class="w-8 h-8 mb-4" />
                        <span class="text-center font-medium">{{ $category->name }}</span>
                    </div>
                @endforeach
            </div>
        </section>

        <hr class="border-gray-200">

        <!-- Best Selling -->
        <section class="section-spacing">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 sm:gap-0 mb-8 sm:mb-10">
                <div>
                    <span class="red-rect"></span><span class="text-[var(--primary-red)] font-semibold">Bulan Ini</span>
                    <h2 class="text-2xl sm:text-3xl font-semibold tracking-wider mt-4">Produk Terlaris</h2>
                </div>
                {{-- Optional: Add View All for best selling --}}
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($this->bestSellingProducts as $product)
                    <livewire:components.product-card :product="$product" :key="'best-'.$product->id" />
                @endforeach
            </div>
        </section>

        <hr class="border-gray-200">

        <div id="product-display">
            @if($selectedCategorySlug)
                <!-- Results when category is filtered -->
                <section class="section-spacing">
                    <div class="mb-10">
                        <span class="red-rect"></span>
                        <span class="text-[var(--primary-red)] font-semibold">Kategori: {{ $this->selectedCategory->name ?? 'Tidak Diketahui' }}</span>
                        <h2 class="text-3xl font-semibold mt-4">Hasil untuk {{ $this->selectedCategory->name ?? 'Produk' }}</h2>
                    </div>

                    @if($this->filteredProducts->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                            @foreach($this->filteredProducts as $product)
                                <livewire:components.product-card :product="$product" :key="'filtered-'.$product->id" />
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-20 bg-gray-50 rounded-lg">
                            <p class="text-gray-500 text-lg">Tidak ada produk di kategori ini.</p>
                        </div>
                    @endif
                </section>
                <hr class="border-gray-200">
            @endif

            <!-- Explore Our Products (All Data) -->
            <section class="section-spacing">
                <div class="mb-8">
                    <span class="red-rect"></span><span class="text-[var(--primary-red)] font-semibold">Produk Kami</span>
                    <h2 class="section-title text-3xl font-semibold mt-4">Jelajahi Produk Kami</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach($this->exploreProducts as $product)
                        <livewire:components.product-card :product="$product" :key="'explore-'.$product->id" />
                    @endforeach
                </div>
                @if(App\Models\Product::count() > $exploreLimit)
                    <div class="text-center mt-10">
                        <button wire:click="loadMore" class="btn-red px-10 py-3">Lihat Semua Produk</button>
                    </div>
                @endif
            </section>
        </div>

        <!-- New Arrivals -->
        <section class="section-spacing">
            <div class="mb-8">
                <span class="red-rect"></span><span class="text-[var(--primary-red)] font-semibold">Unggulan</span>
                <div class="flex items-center gap-4 sm:gap-16 mb-8">
                    <h2 class="text-2xl sm:text-3xl font-semibold tracking-wider">Produk Terbaru</h2>
                </div>
            </div>
            <div class="new-arrival-grid">
                @if($this->newArrivals->count() > 0)
                <div class="new-arrival-card main-poster">
                    <img src="{{ asset('storage/' . $this->newArrivals[0]->thumbnail) }}" class="bg-blur" alt="">
                    <img src="{{ asset('storage/' . $this->newArrivals[0]->thumbnail) }}" class="bg-image" alt="{{ $this->newArrivals[0]->name }}">
                    <div class="content">
                        <h3>{{ $this->newArrivals[0]->name }}</h3>
                        <p>{{ Str::limit($this->newArrivals[0]->about, 50) }}</p>
                        <a href="{{ route('product.detail', $this->newArrivals[0]->slug) }}">Belanja Sekarang</a>
                    </div>
                </div>
                @endif
                
                <div class="flex flex-col gap-8">
                    @if($this->newArrivals->count() > 1)
                    <div class="new-arrival-card flex-1 min-h-[284px]">
                        <img src="{{ asset('storage/' . $this->newArrivals[1]->thumbnail) }}" class="bg-blur" alt="">
                        <img src="{{ asset('storage/' . $this->newArrivals[1]->thumbnail) }}" class="bg-image" alt="{{ $this->newArrivals[1]->name }}">
                        <div class="content">
                            <h3>{{ $this->newArrivals[1]->name }}</h3>
                            <p>{{ Str::limit($this->newArrivals[1]->about, 50) }}</p>
                            <a href="{{ route('product.detail', $this->newArrivals[1]->slug) }}">Shop Now</a>
                        </div>
                    </div>
                    @endif
                    <div class="grid grid-cols-2 gap-8 flex-1">
                        @if($this->newArrivals->count() > 2)
                        <div class="new-arrival-card">
                            <img src="{{ asset('storage/' . $this->newArrivals[2]->thumbnail) }}" class="bg-blur" alt="">
                            <img src="{{ asset('storage/' . $this->newArrivals[2]->thumbnail) }}" class="bg-image" alt="{{ $this->newArrivals[2]->name }}">
                            <div class="content">
                                <h3 class="text-lg">{{ $this->newArrivals[2]->name }}</h3>
                                <a href="{{ route('product.detail', $this->newArrivals[2]->slug) }}" class="text-sm">Shop Now</a>
                            </div>
                        </div>
                        @endif
                        @if($this->newArrivals->count() > 3)
                        <div class="new-arrival-card">
                            <img src="{{ asset('storage/' . $this->newArrivals[3]->thumbnail) }}" class="bg-blur" alt="">
                            <img src="{{ asset('storage/' . $this->newArrivals[3]->thumbnail) }}" class="bg-image" alt="{{ $this->newArrivals[3]->name }}">
                            <div class="content">
                                <h3 class="text-lg">{{ $this->newArrivals[3]->name }}</h3>
                                <a href="{{ route('product.detail', $this->newArrivals[3]->slug) }}" class="text-sm">Shop Now</a>
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
                    <h4 class="font-semibold text-lg mb-2">GRATIS & PENGIRIMAN CEPAT</h4>
                    <p class="text-sm text-[var(--text-gray)]">Gratis ongkir untuk semua pesanan di atas Rp 500.000</p>
                </div>
                <div class="service-item">
                    <div class="service-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h4 class="font-semibold text-lg mb-2">LAYANAN PELANGGAN 24/7</h4>
                    <p class="text-sm text-[var(--text-gray)]">Dukungan pelanggan ramah 24/7</p>
                </div>
                <div class="service-item">
                    <div class="service-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="font-semibold text-lg mb-2">JAMINAN UANG KEMBALI</h4>
                    <p class="text-sm text-[var(--text-gray)]">Kami kembalikan uang dalam 30 hari</p>
                </div>
            </div>
        </section>
    </main>

    <livewire:components.footer />
</div>
