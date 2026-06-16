<div class="flex flex-col md:flex-row gap-8 mb-10 pt-4">
    <!-- Sidebar Categories -->
    <aside class="hidden md:block w-full md:w-1/4 border-r border-gray-200 pr-6 pt-5">
        <ul class="flex flex-col gap-4">
            @foreach($categories as $category)
                <li class="flex justify-between items-center cursor-pointer hover:text-[var(--primary-red)] transition-colors">
                    <span>{{ $category->name }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </li>
            @endforeach
        </ul>
    </aside>

    <!-- Main Banner Slider -->
    @php $bannerList = $banners->count() ? $banners : collect([]); @endphp
    <div class="w-full md:w-3/4 pt-5"
         x-data="{ slide: 0, total: {{ $bannerList->count() ?: 1 }} }"
         x-init="setInterval(() => { slide = (slide + 1) % total }, 5000)">

        @if($bannerList->count())
        <div class="relative overflow-hidden rounded-md min-h-[250px] md:h-[344px]">
            @foreach($bannerList as $i => $banner)
            <div class="absolute inset-0 bg-black text-white flex items-center transition-opacity duration-700"
                 x-show="slide === {{ $i }}"
                 x-transition:enter="transition-opacity duration-700"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-700"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">

                {{-- Background Image --}}
                <img src="{{ asset('storage/' . $banner->image) }}"
                     alt="{{ $banner->title }}"
                     class="absolute right-0 top-0 h-full object-cover w-3/4 sm:w-1/2 opacity-30 sm:opacity-70">

                {{-- Content --}}
                <div class="relative z-10 p-6 md:p-10 w-full sm:w-1/2">
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

            {{-- Dots --}}
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-3 z-20">
                @foreach($bannerList as $i => $banner)
                <span @click="slide = {{ $i }}"
                      :class="slide === {{ $i }} ? 'bg-[var(--primary-red)] border-white border-2' : 'bg-gray-500 border-transparent border-2'"
                      class="w-3 h-3 rounded-full cursor-pointer transition-colors"></span>
                @endforeach
            </div>
        </div>

        @else
        {{-- Fallback jika belum ada banner --}}
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
