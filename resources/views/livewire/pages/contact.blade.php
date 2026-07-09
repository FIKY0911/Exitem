<div class="flex flex-col min-h-screen">
    <livewire:components.navbar />

    {{-- Hero --}}
    <section class="h-[50vh] flex items-center text-white px-5 sm:px-10 lg:px-[10%]"
             style="background:linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65)), url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=1400') center/cover no-repeat;">
        <div>
            <h1 class="text-4xl sm:text-5xl lg:text-[52px] font-extrabold mb-4 tracking-tight">Contact Us</h1>
            <p class="text-sm sm:text-base text-white/85 max-w-[480px] leading-relaxed">Kami siap membantu Anda. Sampaikan pesan, pertanyaan, atau masukan Anda kepada kami.</p>
        </div>
    </section>

    {{-- Contact Card --}}
    <main class="max-w-[1170px] w-full mx-auto px-4 sm:px-5 relative z-10 -mt-10 sm:-mt-16 mb-20">
        <div class="bg-white rounded-2xl shadow-[0_20px_60px_rgba(0,0,0,0.12)] overflow-hidden grid grid-cols-1 lg:grid-cols-[1fr_380px]">

            {{-- Left: Form --}}
            <div class="p-6 sm:p-10 lg:p-14">

                <p class="text-[#DB4444] font-bold text-[12px] tracking-[2px] uppercase mb-3">● MESSAGE ●</p>
                <h2 class="text-2xl sm:text-[28px] font-bold text-[#111] mb-8">Send Us A Message</h2>

                @if(session('success'))
                <div x-data="{ show: true }" x-show="show"
                     x-init="setTimeout(() => show = false, 5000)"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="bg-green-50 border border-green-200 rounded-lg px-4 py-3.5 text-sm text-green-800 mb-6 flex justify-between items-center">
                    {{ session('success') }}
                    <button @click="show=false" class="bg-none border-none cursor-pointer text-green-800 text-base">&times;</button>
                </div>
                @endif

                @php
                    $inp = "w-full p-3.5 sm:p-4 border-2 border-[#eee] rounded-lg text-sm outline-none transition-[border] duration-200 bg-[#fdfdfd] text-[#333] focus:border-[#DB4444] placeholder-gray-400";
                @endphp

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <input wire:model="name" type="text" placeholder="Your Name *" class="{{ $inp }}">
                        @error('name') <p class="text-[11px] text-[#DB4444] mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <input wire:model="email" type="email" placeholder="Your Email *" class="{{ $inp }}">
                        @error('email') <p class="text-[11px] text-[#DB4444] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <input wire:model="phone" type="text" placeholder="Your Phone / Subject" class="{{ $inp }}">
                </div>

                <div class="mb-7">
                    <textarea wire:model="message" rows="6" placeholder="Your Message *"
                              class="{{ $inp }} resize-y"></textarea>
                    @error('message') <p class="text-[11px] text-[#DB4444] mt-1">{{ $message }}</p> @enderror
                </div>

                <button wire:click="send" wire:loading.attr="disabled" wire:loading.class="opacity-70"
                        class="px-10 sm:px-12 py-3.5 sm:py-3.5 bg-[#DB4444] text-white border-none rounded-lg text-sm sm:text-[15px] font-semibold cursor-pointer transition-colors duration-200 tracking-[0.3px] hover:bg-[#c83333]">
                    <span wire:loading.remove>Submit Message</span>
                    <span wire:loading>Sending...</span>
                </button>
            </div>

            {{-- Right: Info --}}
            <div class="bg-[#1a1a1a] p-8 sm:p-10 lg:p-14 flex flex-col gap-8">
                <div>
                    <p class="text-[#DB4444] font-bold text-[12px] tracking-[2px] uppercase mb-5">GET IN TOUCH</p>
                </div>

                @foreach([
                    ['📍', 'Our Location',  'Jl. Sudirman No. 123,<br>Jakarta Selatan, Indonesia'],
                    ['📞', 'Phone Call',    '+62 812 3456 7890'],
                    ['✉️', 'Email Us',      'support@exitem.com<br>customer@exitem.com'],
                ] as $info)
                <div class="flex gap-4 items-start">
                    <div class="w-11 h-11 bg-[#DB4444] rounded-full flex items-center justify-center text-lg shrink-0">{{ $info[0] }}</div>
                    <div>
                        <h4 class="text-sm font-semibold text-white mb-1.5">{{ $info[1] }}</h4>
                        <p class="text-[13px] text-[#aaa] leading-relaxed">{!! $info[2] !!}</p>
                    </div>
                </div>
                @endforeach

                <div class="mt-auto pt-8 border-t border-[#333]">
                    <p class="text-xs text-[#666] mb-4">Follow Us</p>
                    <div class="flex gap-2.5">
                        @foreach(['T','I','F','L'] as $s)
                        <a href="#"
                           class="w-9 h-9 rounded-full bg-[#333] flex items-center justify-center text-white text-xs font-semibold no-underline transition-colors duration-200 hover:bg-[#DB4444]">{{ $s }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </main>

    <livewire:components.footer />
</div>
