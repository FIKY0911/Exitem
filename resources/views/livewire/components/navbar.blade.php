<header class="{{ $dark ? 'bg-black text-white border-b border-white/10' : 'bg-white text-black border-b border-gray-200' }} sticky top-0 z-50 transition-colors duration-300" x-data="{ mobileMenuOpen: false, searchOpen: false }">
    {{-- Promo banner: hidden on mobile --}}
    <div class="hidden md:block bg-black text-white text-center py-2 text-sm px-4">
        <p>Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%! <a href="#" class="font-bold underline ml-2">ShopNow</a></p>
    </div>

    <div class="container-max flex items-center justify-between gap-6 px-6 sm:px-10 lg:px-16" style="padding-top: 1.5rem; padding-bottom: 1.5rem;">

        {{-- Left: Hamburger + Logo --}}
        <div class="flex items-center gap-4 sm:gap-6">
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="{{ $dark ? 'text-white' : 'text-black' }} focus:outline-none md:hidden">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-cloak x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <a href="{{ route('home') }}"
               @click.prevent="
                   if (window.location.pathname === '/') {
                       window.scrollTo({ top: 0, behavior: 'smooth' });
                   } else {
                       window.location.href = '{{ route('home') }}';
                   }
               "
               class="logo text-2xl sm:text-3xl font-bold font-secondary cursor-pointer">
                Exitem
            </a>
        </div>

        {{-- Center: Desktop Nav --}}
        <nav class="hidden md:flex gap-10 py-2 text-base">
            @php
                $navLinks = [
                    ['route' => 'home',     'label' => 'Home'],
                    ['route' => 'products', 'label' => 'Products'],
                    ['route' => 'contact',  'label' => 'Contact'],
                    ['route' => 'about',    'label' => 'About'],
                ];
            @endphp
            @foreach($navLinks as $link)
                @php $isActive = request()->routeIs($link['route']); @endphp
                <a href="{{ route($link['route']) }}"
                   style="position:relative; font-weight:500; text-decoration:none; padding-bottom:4px;
                          color:{{ $isActive ? ($dark ? '#fff' : '#000') : '#7D8184' }};
                          transition:color 0.2s;">
                    {{ $link['label'] }}
                    <span style="position:absolute; bottom:0; left:0; width:100%; height:2px;
                                 background:{{ $dark ? '#fff' : '#000' }}; border-radius:1px;
                                 transform:scaleX({{ $isActive ? '1' : '0' }});
                                 transform-origin:left;
                                 transition:transform 0.2s ease;"
                          class="nav-underline"></span>
                </a>
            @endforeach
            @guest
            <a href="{{ route('signup') }}"
               style="font-weight:500; text-decoration:none; color:#7D8184; transition:color 0.2s;"
               onmouseover="this.style.color='{{ $dark ? '#fff' : '#000' }}'" onmouseout="this.style.color='#7D8184'">
                Sign Up
            </a>
            @endguest
        </nav>

        {{-- Right: Search + Icons --}}
        <div class="flex items-center gap-4 sm:gap-5">

            {{-- Desktop Search Box (ONLY visible md and above) --}}
            <div class="hidden md:block relative" x-data="{ showSuggestions: @entangle('suggestions').live }">
                <div class="search-box">
                    <input type="text" 
                           wire:model.live.debounce.300ms="search" 
                           wire:keydown.enter="performSearch" 
                           placeholder="What are you looking for?" 
                           class="text-black placeholder-gray-500">
                    <svg class="w-5 h-5 text-[var(--text-gray)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                
                @if(count($suggestions) > 0)
                <div class="absolute top-full mt-3 w-full bg-white rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.12)] z-50 overflow-hidden border border-gray-100 py-2">
                    @foreach($suggestions as $product)
                    <a href="{{ route('product.detail', $product['slug']) }}" 
                       class="flex items-center gap-4 px-4 py-3 hover:bg-gray-50 transition-all duration-200 group">
                        <div class="relative w-14 h-14 shrink-0 overflow-hidden rounded-md bg-gray-50 border border-gray-100 flex items-center justify-center">
                            <img src="{{ $product['thumbnail'] ? asset('storage/' . $product['thumbnail']) : '/images/placeholder.jpg' }}" 
                                 class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300" 
                                 alt="{{ $product['name'] }}">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-[15px] font-medium text-gray-900 truncate">{{ $product['name'] }}</p>
                            <p class="text-sm font-semibold text-[var(--primary-red)] mt-0.5">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Mobile Search Icon (ONLY visible below md) --}}
            <button @click.stop="searchOpen = !searchOpen"
                    class="{{ $dark ? 'text-white hover:text-white/80' : 'text-black hover:text-[var(--primary-red)]' }} transition-colors md:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>

            {{-- Wishlist --}}
            <a href="{{ route('wishlist') }}" class="{{ $dark ? 'text-white hover:text-white/80' : 'text-black hover:text-[var(--primary-red)]' }} transition-colors relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                @if($wishlistCount > 0)
                <span data-wishlist-count class="absolute -top-1 -right-2 bg-[var(--primary-red)] text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">
                    {{ $wishlistCount }}
                </span>
                @else
                <span data-wishlist-count class="absolute -top-1 -right-2 bg-[var(--primary-red)] text-white text-[10px] w-4 h-4 rounded-full items-center justify-center" style="display:none">0</span>
                @endif
            </a>

            {{-- Cart --}}
            <a href="{{ route('cart') }}" class="{{ $dark ? 'text-white hover:text-white/80' : 'text-black hover:text-[var(--primary-red)]' }} transition-colors relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                @if($cartCount > 0)
                <span data-cart-count class="absolute -top-1 -right-2 bg-[var(--primary-red)] text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">
                    {{ $cartCount }}
                </span>
                @else
                <span data-cart-count class="absolute -top-1 -right-2 bg-[var(--primary-red)] text-white text-[10px] w-4 h-4 rounded-full items-center justify-center" style="display:none">0</span>
                @endif
            </a>

            {{-- Profile / Login --}}
            @auth
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="{{ $dark ? 'text-white hover:text-white/80' : 'text-black hover:text-[var(--primary-red)]' }} transition-colors focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-3 w-64 rounded-md shadow-lg py-1 z-50 overflow-hidden flex flex-col"
                         style="background: linear-gradient(180deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.9) 100%); backdrop-filter: blur(10px); display: none;">
                        
                        <a href="{{ route('my-account') }}" style="display: flex; align-items: center; gap: 1rem;" class="px-4 py-3 text-sm text-white hover:bg-white/10 transition-colors w-full whitespace-nowrap group">
                            <svg class="w-6 h-6 opacity-90 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span class="text-[15px]">Manage My Account</span>
                        </a>
                        
                        <a href="{{ route('my-orders') }}" style="display: flex; align-items: center; gap: 1rem;" class="px-4 py-3 text-sm text-white hover:bg-white/10 transition-colors w-full whitespace-nowrap group">
                            <svg class="w-6 h-6 opacity-90 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            <span class="text-[15px]">My Order</span>
                        </a>
                        
                        <a href="{{ route('my-collection') }}" style="display: flex; align-items: center; gap: 1rem;" class="px-4 py-3 text-sm text-white hover:bg-white/10 transition-colors w-full whitespace-nowrap group">
                            <svg class="w-6 h-6 opacity-90 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-[15px]">My Cancellations</span>
                        </a>
                        
                        <a href="{{ route('my-reviews') }}" style="display: flex; align-items: center; gap: 1rem;" class="px-4 py-3 text-sm text-white hover:bg-white/10 transition-colors w-full whitespace-nowrap group">
                            <svg class="w-6 h-6 opacity-90 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.482-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            <span class="text-[15px]">My Reviews</span>
                        </a>
                        
                        <button wire:click="logout" style="display: flex; align-items: center; gap: 1rem;" class="w-full px-4 py-3 text-sm text-white hover:bg-white/10 transition-colors border-t border-white/10 whitespace-nowrap group">
                            <svg class="w-6 h-6 opacity-90 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                            <span class="text-[15px]">Logout</span>
                        </button>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="{{ $dark ? 'text-white hover:text-white/80' : 'text-black hover:text-[var(--primary-red)]' }} transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                </a>
            @endauth
        </div>
    </div>

    {{-- Mobile Dropdown Menu --}}
    <div x-cloak x-show="mobileMenuOpen"
         @click.outside="mobileMenuOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden absolute w-full {{ $dark ? 'bg-black text-white' : 'bg-white' }} z-50 shadow-lg border-t {{ $dark ? 'border-white/10' : 'border-gray-100' }}"
         style="display:none">
        <nav class="flex flex-col px-10 py-5 gap-5 text-base">
            <a href="{{ route('home') }}" class="font-medium text-[var(--primary-red)]">Home</a>
            <a href="{{ route('products') }}" class="font-medium hover:text-[var(--primary-red)] transition-colors">Products</a>
            <a href="{{ route('contact') }}" class="font-medium hover:text-[var(--primary-red)] transition-colors">Contact</a>
            <a href="{{ route('about') }}" class="font-medium hover:text-[var(--primary-red)] transition-colors">About</a>
            @guest
            <a href="{{ route('signup') }}" class="font-medium hover:text-[var(--primary-red)] transition-colors">Sign Up</a>
            @endguest
        </nav>
    </div>

    {{-- Mobile Search Dropdown (appears when search icon clicked) --}}
    <div x-cloak x-show="searchOpen"
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="md:hidden absolute w-full {{ $dark ? 'bg-black text-white' : 'bg-white' }} z-40 shadow-md border-t {{ $dark ? 'border-white/10' : 'border-gray-100' }}"
         style="display:none">
        <div class="px-4 py-3">
            <div class="search-box search-full w-full" @click.stop style="display: flex; align-items: center; justify-content: space-between;">
                <svg class="w-5 h-5 text-[var(--text-gray)] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" wire:model.live.debounce.300ms="search" wire:keydown.enter="performSearch" placeholder="What are you looking for?"
                       class="flex-1 min-w-0 bg-transparent outline-none mx-2 text-black placeholder-gray-500"
                       x-ref="searchInput"
                       x-init="$watch('searchOpen', val => val && $nextTick(() => $refs.searchInput.focus()))">
                <button @click.stop="searchOpen = false" class="shrink-0 text-gray-400 hover:text-gray-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
        
        @if(count($suggestions) > 0)
        <div class="border-t {{ $dark ? 'border-white/10' : 'border-gray-100' }} py-2">
            @foreach($suggestions as $product)
            <a href="{{ route('product.detail', $product['slug']) }}" 
               class="flex items-center gap-4 px-4 py-3 {{ $dark ? 'hover:bg-white/5' : 'hover:bg-gray-50' }} transition-colors group">
                <div class="relative w-14 h-14 shrink-0 overflow-hidden rounded-md {{ $dark ? 'bg-white/5 border-white/10' : 'bg-gray-50 border-gray-100' }} border flex items-center justify-center">
                    <img src="{{ $product['thumbnail'] ? asset('storage/' . $product['thumbnail']) : '/images/placeholder.jpg' }}" 
                         class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300" 
                         alt="{{ $product['name'] }}">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-[15px] font-medium truncate {{ $dark ? 'text-white' : 'text-gray-900' }}">{{ $product['name'] }}</p>
                    <p class="text-sm font-semibold text-[var(--primary-red)] mt-0.5">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
    {{-- Invisible overlay to close search when clicking outside --}}
    <div x-cloak x-show="searchOpen" @click="searchOpen = false"
         class="md:hidden fixed inset-0 z-30" style="display:none"></div>
</header>
