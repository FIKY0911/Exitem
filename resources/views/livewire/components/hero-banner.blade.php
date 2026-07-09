<div class="mb-10 pt-4">
    <!-- Main Banner Slider Container -->
    @php $bannerList = $banners->count() ? $banners : collect([]); @endphp
    <div class="w-full pt-5"
         x-data="{ slide: 0, total: {{ $bannerList->count() ?: 1 }} }"
         x-init="setInterval(() => { slide = (slide + 1) % total }, 5000)">

        @if($bannerList->count())
        {{-- Wrapper with Dynamic Gradient Background --}}
        <div class="relative overflow-hidden rounded-md min-h-[250px] md:h-[344px]" 
             style="position: relative; background: radial-gradient(circle at 20% 50%, #2c2c2c 0%, #000000 100%);">
            
            {{-- Slides --}}
            @foreach($bannerList as $i => $banner)
            <div class="absolute inset-0 w-full h-full flex items-center transition-opacity duration-700"
                 x-show="slide === {{ $i }}"
                 style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                 x-transition:enter="transition-opacity duration-700"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-700"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">

                {{-- Decorative Glow behind text --}}
                <div class="absolute left-[10%] top-1/2 -translate-y-1/2 w-[300px] h-[300px] rounded-full blur-[100px] opacity-20 bg-[var(--primary-red)] z-0" style="position: absolute;"></div>

                {{-- Background/Banner Image --}}
                <div class="absolute right-0 top-0 h-full w-[60%] z-5" style="position: absolute; right: 0; top: 0; height: 100%; width: 60%; overflow: hidden;">
                    <img src="{{ asset('storage/' . $banner->image) }}"
                         alt="{{ $banner->title }}"
                         class="h-full w-full object-contain"
                         style="height: 100%; width: 100%; object-fit: contain;">
                    
                    {{-- Right-side gradient overlay to blend image edge with black background --}}
                    <div class="absolute inset-y-0 right-0 w-20 z-10" style="position: absolute; top: 0; bottom: 0; right: 0; width: 80px; background: linear-gradient(270deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 100%);"></div>
                </div>

                {{-- Refined Overlay for smoother transition from left --}}
                <div class="absolute inset-y-0 left-0 z-10" 
                     style="position: absolute; inset-y: 0; left: 0; width: 65%; 
                            background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0.8) 30%, rgba(0,0,0,0.4) 70%, rgba(0,0,0,0) 100%);"></div>

                {{-- Content Layer --}}
                <div class="relative z-20 p-6 md:p-14 w-full sm:w-1/2 text-white">
                    <span class="text-sm md:text-base mb-3 block">{{ $banner->subtitle }}</span>
                    <h2 class="text-3xl md:text-5xl font-semibold leading-tight mb-4 md:mb-6">
                        {!! nl2br(e($banner->title)) !!}
                    </h2>
                    <a href="{{ $banner->cta_url ? route('product.detail', $banner->cta_url) : '#' }}"
                       class="border-b border-white pb-1 font-medium inline-flex items-center gap-2 hover:text-gray-300 transition-colors text-sm md:text-base">
                        {{ $banner->cta_label }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach

            {{-- Navigation Arrows - Positioning Fixed with Flex & Absolute --}}
            {{-- Left Arrow --}}
            <div style="position: absolute; left: 16px; top: 0; bottom: 0; display: flex; align-items: center; z-index: 40;">
                <button @click="slide = (slide - 1 + total) % total" 
                        class="w-10 h-10 rounded-full bg-black/50 hover:bg-black/80 text-white flex items-center justify-center transition-all focus:outline-none shadow-lg border border-white/10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
            </div>

            {{-- Right Arrow --}}
            <div style="position: absolute; right: 16px; top: 0; bottom: 0; display: flex; align-items: center; z-index: 40;">
                <button @click="slide = (slide + 1) % total" 
                        class="w-10 h-10 rounded-full bg-black/50 hover:bg-black/80 text-white flex items-center justify-center transition-all focus:outline-none shadow-lg border border-white/10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            {{-- Dots - Positioned absolutely at bottom center --}}
            <div style="position: absolute; bottom: 16px; left: 0; right: 0; display: flex; justify-content: center; gap: 12px; z-index: 40;">
                @foreach($bannerList as $i => $banner)
                <span @click="slide = {{ $i }}"
                      class="w-3 h-3 rounded-full cursor-pointer transition-all duration-300 border-2"
                      :class="slide === {{ $i }} ? 'bg-[var(--primary-red)] border-white scale-110' : 'bg-gray-400 border-transparent'"></span>
                @endforeach
            </div>
        </div>

        @else
        {{-- Fallback --}}
        <div class="bg-black text-white p-6 md:p-10 flex flex-col justify-center min-h-[250px] md:h-[344px] rounded-md">
            <span class="text-sm mb-3">Welcome to ExItem</span>
            <h2 class="text-3xl md:text-5xl font-semibold leading-tight mb-5">Best Electronics<br>Deals Here</h2>
            <a href="#" class="border-b border-white pb-1 font-medium inline-flex items-center gap-2 text-sm md:text-base">
                Shop Now
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
        @endif
    </div>
</div>
