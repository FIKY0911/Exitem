<div class="flex flex-col min-h-screen">
    <livewire:components.navbar />

    {{-- Hero --}}
    <section class="h-[60vh] flex items-center justify-center text-center text-white px-5"
             style="background:linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65)), url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=1400') center/cover no-repeat;">
        <div>
            <h1 class="text-4xl sm:text-5xl lg:text-[52px] font-extrabold tracking-tight mb-4">{{ $heroTitle }}</h1>
            <p class="text-sm sm:text-base text-white/85 max-w-[500px] mx-auto">{{ $heroSubtitle }}</p>
        </div>
    </section>

    {{-- Stats (Dynamic) --}}
    <section class="bg-white shadow-[0_4px_24px_rgba(0,0,0,0.08)] py-8">
        <div class="max-w-[1170px] mx-auto px-5 grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-0">
            @foreach($stats as $i => $s)
            <div class="text-center p-6 {{ $i < count($stats)-1 ? 'sm:border-r sm:border-[#f0f0f0]' : '' }}">
                <div class="text-4xl sm:text-5xl font-extrabold text-[#DB4444] leading-none">{{ $s['value'] }}</div>
                <div class="text-sm text-[#666] mt-2">{{ $s['label'] }}</div>
            </div>
            @endforeach
        </div>
    </section>

    <main class="max-w-[1170px] mx-auto px-5 py-16 sm:py-20 flex-1 w-full">

        {{-- Who We Are (Dynamic) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16 items-center mb-16 md:mb-20">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600" alt="Team"
                 class="w-full rounded-2xl shadow-[0_8px_32px_rgba(0,0,0,0.12)]">
            <div>
                <p class="text-[#DB4444] font-bold text-[12px] tracking-[2px] uppercase mb-4">● WHO WE ARE ●</p>
                <h2 class="text-2xl sm:text-3xl font-bold text-[#111] mb-6 leading-tight">{{ $storyHeadline }}</h2>
                @if($storyText1)
                <p class="text-sm sm:text-base leading-relaxed text-[#666] mb-4">{{ $storyText1 }}</p>
                @endif
                @if($storyText2)
                <p class="text-sm sm:text-base leading-relaxed text-[#666]">{{ $storyText2 }}</p>
                @endif
            </div>
        </div>

        {{-- Vision & Mission (Dynamic) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-16 md:mb-20">
            <div class="bg-white border border-[#f0f0f0] rounded-xl p-8 sm:p-10 text-center shadow-[0_2px_12px_rgba(0,0,0,0.06)]">
                <div class="text-4xl mb-4">👁️</div>
                <h3 class="text-lg sm:text-xl font-bold text-[#111] mb-4">Our Vision</h3>
                <p class="text-sm sm:text-base text-[#666] leading-relaxed">{{ $vision }}</p>
            </div>
            <div class="bg-white border border-[#f0f0f0] rounded-xl p-8 sm:p-10 text-center shadow-[0_2px_12px_rgba(0,0,0,0.06)]">
                <div class="text-4xl mb-4">🚀</div>
                <h3 class="text-lg sm:text-xl font-bold text-[#111] mb-4">Our Mission</h3>
                @if(count($mission))
                <ul class="text-sm sm:text-base text-[#666] leading-relaxed text-left pl-5 space-y-2">
                    @foreach($mission as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

        {{-- Team (Dynamic from DB) --}}
        @if($teamMembers->count())
        <section class="bg-[#1a1a1a] rounded-2xl p-8 sm:p-10 lg:p-[60px_40px] mb-16 md:mb-20"
                 x-data="{
                     slide: 0,
                     total: {{ $teamMembers->count() }},
                     perPage: 1,
                     timer: null,
                     startAuto() { this.timer = setInterval(() => this.next(), 3000); },
                     stopAuto()  { clearInterval(this.timer); },
                     next() { this.slide = (this.slide + 1) % Math.ceil(this.total / this.perPage); },
                     prev() { const max = Math.ceil(this.total / this.perPage); this.slide = (this.slide - 1 + max) % max; },
                     get visible() {
                         const start = this.slide * this.perPage;
                         return Array.from({ length: this.total }, (_, i) => i).slice(start, start + this.perPage);
                     }
                 }"
                 x-init="
                     perPage = window.innerWidth >= 1024 ? 3 : window.innerWidth >= 640 ? 2 : 1;
                     $watch('slide', () => {});
                     startAuto();
                 "
                 @resize.window="
                     perPage = window.innerWidth >= 1024 ? 3 : window.innerWidth >= 640 ? 2 : 1;
                     const max = Math.ceil(total / perPage);
                     if (slide >= max) slide = max - 1;
                 ">
            <div class="text-center mb-10">
                <p class="text-[#DB4444] font-bold text-[12px] tracking-[2px] uppercase mb-3">OUR TEAM</p>
                <h2 class="text-2xl sm:text-3xl font-bold text-white">Meet The Team</h2>
            </div>

            {{-- Slider + Arrows --}}
            <div class="relative px-0 sm:px-6">
                {{-- Left Arrow --}}
                <button @click="stopAuto(); prev(); startAuto()"
                        class="absolute left-0 sm:-left-5 top-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full bg-[#333] border-none cursor-pointer flex items-center justify-center text-white transition-colors duration-200 hover:bg-[#DB4444]">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <div class="overflow-hidden">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($teamMembers as $i => $member)
                        <div x-show="Math.floor({{ $i }} / perPage) === slide"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-x-4"
                             x-transition:enter-end="opacity-100 translate-x-0"
                             class="bg-[#2a2a2a] rounded-xl p-8 text-center">
                            <div class="w-20 h-20 rounded-full overflow-hidden mx-auto mb-4 bg-[#DB4444] flex items-center justify-center">
                                @if($member->photo)
                                <img src="{{ asset('storage/'.$member->photo) }}" class="w-full h-full object-cover">
                                @else
                                <span class="text-white text-2xl font-bold">{{ strtoupper(substr($member->name,0,1)) }}</span>
                                @endif
                            </div>
                            <h4 class="text-base font-semibold text-white mb-1.5">{{ $member->name }}</h4>
                            <p class="text-[13px] text-[#aaa]">{{ $member->role }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right Arrow --}}
                <button @click="stopAuto(); next(); startAuto()"
                        class="absolute right-0 sm:-right-5 top-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-full bg-[#333] border-none cursor-pointer flex items-center justify-center text-white transition-colors duration-200 hover:bg-[#DB4444]">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            {{-- Dots --}}
            <div class="flex justify-center gap-2 mt-8">
                @foreach($teamMembers as $i => $member)
                <button @click="slide = Math.floor({{ $i }} / perPage)"
                        :style="Math.floor({{ $i }} / perPage) === slide ? 'background:#DB4444;' : 'background:#555;'"
                        class="w-2.5 h-2.5 rounded-full border-none cursor-pointer transition-colors duration-200"></button>
                @endforeach
            </div>
        </section>
        @endif

    </main>

    <livewire:components.footer />
</div>
