<div class="flex flex-col min-h-screen">
    <livewire:components.navbar />

    {{-- Hero --}}
    <section style="height:50vh; background:linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65)), url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=1400') center/cover no-repeat; display:flex; align-items:center; color:#fff; padding:0 10%;">
        <div>
            <h1 style="font-size:52px; font-weight:800; margin-bottom:16px; letter-spacing:-1px;">Contact Us</h1>
            <p style="font-size:16px; opacity:0.85; max-width:480px; line-height:1.7;">Kami siap membantu Anda. Sampaikan pesan, pertanyaan, atau masukan Anda kepada kami.</p>
        </div>
    </section>

    {{-- Contact Card --}}
    <main style="max-width:1170px; margin:-60px auto 80px; padding:0 20px; width:100%; position:relative; z-index:10;">
        <div style="background:#fff; border-radius:16px; box-shadow:0 20px 60px rgba(0,0,0,0.12); overflow:hidden; display:grid; grid-template-columns:1fr 380px;">

            {{-- Left: Form --}}
            <div style="padding:56px 48px;">

                <p style="color:#DB4444; font-weight:700; font-size:12px; letter-spacing:2px; text-transform:uppercase; margin-bottom:12px;">● MESSAGE ●</p>
                <h2 style="font-size:28px; font-weight:700; color:#111; margin-bottom:32px;">Send Us A Message</h2>

                @if(session('success'))
                <div x-data="{ show: true }" x-show="show"
                     x-init="setTimeout(() => show = false, 5000)"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; padding:14px 16px; font-size:13px; color:#166534; margin-bottom:24px; display:flex; justify-content:space-between; align-items:center;">
                    {{ session('success') }}
                    <button @click="show=false" style="background:none;border:none;cursor:pointer;color:#166534;font-size:16px;">✕</button>
                </div>
                @endif

                @php $inp = "width:100%; padding:14px 16px; border:1.5px solid #eee; border-radius:8px; font-size:14px; outline:none; box-sizing:border-box; transition:border 0.2s; background:#fdfdfd; color:#333;"; @endphp

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px;">
                    <div>
                        <input wire:model="name" type="text" placeholder="Your Name *" style="{{ $inp }}"
                               onfocus="this.style.borderColor='#DB4444'" onblur="this.style.borderColor='#eee'">
                        @error('name') <p style="font-size:11px;color:#DB4444;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <input wire:model="email" type="email" placeholder="Your Email *" style="{{ $inp }}"
                               onfocus="this.style.borderColor='#DB4444'" onblur="this.style.borderColor='#eee'">
                        @error('email') <p style="font-size:11px;color:#DB4444;margin-top:4px;">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div style="margin-bottom:16px;">
                    <input wire:model="phone" type="text" placeholder="Your Phone / Subject" style="{{ $inp }}"
                           onfocus="this.style.borderColor='#DB4444'" onblur="this.style.borderColor='#eee'">
                </div>

                <div style="margin-bottom:28px;">
                    <textarea wire:model="message" rows="6" placeholder="Your Message *"
                              style="{{ $inp }} resize:vertical;"
                              onfocus="this.style.borderColor='#DB4444'" onblur="this.style.borderColor='#eee'"></textarea>
                    @error('message') <p style="font-size:11px;color:#DB4444;margin-top:4px;">{{ $message }}</p> @enderror
                </div>

                <button wire:click="send" wire:loading.attr="disabled" wire:loading.class="opacity-70"
                        style="padding:14px 48px; background:#DB4444; color:#fff; border:none; border-radius:8px; font-size:15px; font-weight:600; cursor:pointer; transition:background 0.2s; letter-spacing:0.3px;"
                        onmouseover="this.style.background='#c83333'" onmouseout="this.style.background='#DB4444'">
                    <span wire:loading.remove>Submit Message</span>
                    <span wire:loading>Sending...</span>
                </button>
            </div>

            {{-- Right: Info --}}
            <div style="background:#1a1a1a; padding:56px 40px; display:flex; flex-direction:column; gap:32px;">
                <div>
                    <p style="color:#DB4444; font-weight:700; font-size:12px; letter-spacing:2px; text-transform:uppercase; margin-bottom:20px;">GET IN TOUCH</p>
                </div>

                @foreach([
                    ['📍', 'Our Location',  'Jl. Sudirman No. 123,<br>Jakarta Selatan, Indonesia'],
                    ['📞', 'Phone Call',    '+62 812 3456 7890'],
                    ['✉️', 'Email Us',      'support@exitem.com<br>customer@exitem.com'],
                ] as $info)
                <div style="display:flex; gap:16px; align-items:flex-start;">
                    <div style="width:44px;height:44px;background:#DB4444;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">{{ $info[0] }}</div>
                    <div>
                        <h4 style="font-size:14px;font-weight:600;color:#fff;margin-bottom:6px;">{{ $info[1] }}</h4>
                        <p style="font-size:13px;color:#aaa;line-height:1.7;">{!! $info[2] !!}</p>
                    </div>
                </div>
                @endforeach

                <div style="margin-top:auto; padding-top:32px; border-top:1px solid #333;">
                    <p style="font-size:12px; color:#666; margin-bottom:16px;">Follow Us</p>
                    <div style="display:flex; gap:10px;">
                        @foreach(['T','I','F','L'] as $s)
                        <a href="#" style="width:36px;height:36px;border-radius:50%;background:#333;display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;font-weight:600;text-decoration:none;transition:background 0.2s;"
                           onmouseover="this.style.background='#DB4444'" onmouseout="this.style.background='#333'">{{ $s }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </main>

    <livewire:components.footer />
</div>
