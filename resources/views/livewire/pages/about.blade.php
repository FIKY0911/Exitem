<div class="flex flex-col min-h-screen">
    <livewire:components.navbar />

    {{-- Hero --}}
    <section style="height:60vh; background:linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65)), url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=1400') center/cover no-repeat; display:flex; align-items:center; justify-content:center; text-align:center; color:#fff;">
        <div>
            <h1 style="font-size:52px; font-weight:800; letter-spacing:-1px; margin-bottom:16px;">{{ $heroTitle }}</h1>
            <p style="font-size:16px; opacity:0.85; max-width:500px; margin:0 auto;">{{ $heroSubtitle }}</p>
        </div>
    </section>

    {{-- Stats (Dynamic) --}}
    <section style="background:#fff; box-shadow:0 4px 24px rgba(0,0,0,0.08); padding:32px 0;">
        <div style="max-width:1170px; margin:0 auto; padding:0 20px; display:grid; grid-template-columns:repeat({{ count($stats) }},1fr); gap:0;">
            @foreach($stats as $i => $s)
            <div style="text-align:center; padding:24px; {{ $i < count($stats)-1 ? 'border-right:1px solid #f0f0f0;' : '' }}">
                <div style="font-size:40px; font-weight:800; color:#DB4444; line-height:1;">{{ $s['value'] }}</div>
                <div style="font-size:14px; color:#666; margin-top:8px;">{{ $s['label'] }}</div>
            </div>
            @endforeach
        </div>
    </section>

    <main style="max-width:1170px; margin:0 auto; padding:80px 20px; flex:1; width:100%;">

        {{-- Who We Are (Dynamic) --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:64px; align-items:center; margin-bottom:80px;">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600" alt="Team"
                 style="width:100%; border-radius:16px; box-shadow:0 8px 32px rgba(0,0,0,0.12);">
            <div>
                <p style="color:#DB4444; font-weight:700; font-size:12px; letter-spacing:2px; text-transform:uppercase; margin-bottom:16px;">● WHO WE ARE ●</p>
                <h2 style="font-size:32px; font-weight:700; color:#111; margin-bottom:24px; line-height:1.2;">{{ $storyHeadline }}</h2>
                @if($storyText1)
                <p style="font-size:14px; line-height:1.9; color:#666; margin-bottom:16px;">{{ $storyText1 }}</p>
                @endif
                @if($storyText2)
                <p style="font-size:14px; line-height:1.9; color:#666;">{{ $storyText2 }}</p>
                @endif
            </div>
        </div>

        {{-- Vision & Mission (Dynamic) --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:80px;">
            <div style="background:#fff; border:1px solid #f0f0f0; border-radius:12px; padding:40px; text-align:center; box-shadow:0 2px 12px rgba(0,0,0,0.06);">
                <div style="font-size:40px; margin-bottom:16px;">👁️</div>
                <h3 style="font-size:20px; font-weight:700; color:#111; margin-bottom:16px;">Our Vision</h3>
                <p style="font-size:14px; color:#666; line-height:1.8;">{{ $vision }}</p>
            </div>
            <div style="background:#fff; border:1px solid #f0f0f0; border-radius:12px; padding:40px; text-align:center; box-shadow:0 2px 12px rgba(0,0,0,0.06);">
                <div style="font-size:40px; margin-bottom:16px;">🚀</div>
                <h3 style="font-size:20px; font-weight:700; color:#111; margin-bottom:16px;">Our Mission</h3>
                @if(count($mission))
                <ul style="font-size:14px; color:#666; line-height:2; text-align:left; padding-left:20px;">
                    @foreach($mission as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

        {{-- Team (Dynamic from DB) --}}
        @if($teamMembers->count())
        <section style="background:#1a1a1a; border-radius:16px; padding:60px 40px; margin-bottom:80px;"
                 x-data="{
                     slide: 0,
                     total: {{ $teamMembers->count() }},
                     perPage: 3,
                     timer: null,
                     startAuto() { this.timer = setInterval(() => this.next(), 3000); },
                     stopAuto()  { clearInterval(this.timer); },
                     next() { this.slide = (this.slide + 1) % this.total; },
                     prev() { this.slide = (this.slide - 1 + this.total) % this.total; },
                 }"
                 x-init="startAuto()">
            <div style="text-align:center; margin-bottom:40px;">
                <p style="color:#DB4444; font-weight:700; font-size:12px; letter-spacing:2px; text-transform:uppercase; margin-bottom:12px;">OUR TEAM</p>
                <h2 style="font-size:32px; font-weight:700; color:#fff;">Meet The Team</h2>
            </div>

            {{-- Slider + Arrows --}}
            <div style="position:relative;">
                {{-- Left Arrow --}}
                <button @click="stopAuto(); prev(); startAuto()"
                        style="position:absolute; left:-20px; top:50%; transform:translateY(-50%); z-index:10;
                               width:44px; height:44px; border-radius:50%; background:#333; border:none; cursor:pointer;
                               display:flex; align-items:center; justify-content:center; color:#fff; transition:background 0.2s;"
                        onmouseover="this.style.background='#DB4444'" onmouseout="this.style.background='#333'">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:24px; overflow:hidden;">
                    @foreach($teamMembers as $i => $member)
                    <div x-show="{{ $i }} >= slide && {{ $i }} < slide + 3"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         style="background:#2a2a2a; border-radius:12px; padding:32px 24px; text-align:center;">
                        <div style="width:80px;height:80px;border-radius:50%;overflow:hidden;margin:0 auto 16px;background:#DB4444;display:flex;align-items:center;justify-content:center;">
                            @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                            <span style="color:#fff;font-size:28px;font-weight:700;">{{ strtoupper(substr($member->name,0,1)) }}</span>
                            @endif
                        </div>
                        <h4 style="font-size:16px;font-weight:600;color:#fff;margin-bottom:6px;">{{ $member->name }}</h4>
                        <p style="font-size:13px;color:#aaa;margin-bottom:16px;">{{ $member->role }}</p>
                    </div>
                    @endforeach
                </div>

                {{-- Right Arrow --}}
                <button @click="stopAuto(); next(); startAuto()"
                        style="position:absolute; right:-20px; top:50%; transform:translateY(-50%); z-index:10;
                               width:44px; height:44px; border-radius:50%; background:#333; border:none; cursor:pointer;
                               display:flex; align-items:center; justify-content:center; color:#fff; transition:background 0.2s;"
                        onmouseover="this.style.background='#DB4444'" onmouseout="this.style.background='#333'">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            {{-- Dots --}}
            <div style="display:flex;justify-content:center;gap:8px;margin-top:32px;">
                @foreach($teamMembers as $i => $member)
                <button @click="slide = {{ $i }}"
                        :style="slide === {{ $i }} ? 'background:#DB4444;' : 'background:#555;'"
                        style="width:10px;height:10px;border-radius:50%;border:none;cursor:pointer;transition:background 0.2s;"></button>
                @endforeach
            </div>
        </section>
        @endif

    </main>

    <livewire:components.footer />
</div>
