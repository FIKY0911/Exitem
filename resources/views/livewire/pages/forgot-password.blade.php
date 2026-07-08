<div>
    <livewire:components.navbar :dark="false" />

    <main class="bg-transparent bg-cover bg-center bg-no-repeat text-white min-h-screen flex items-center justify-center font-['Poppins']" style="background-image: url('/storage/background-auth/image-auth.webp');">
        <div class="bg-black/45 backdrop-blur-sm rounded-[20px] p-14 w-full max-w-[450px] shadow-[0_10px_28px_rgba(0,0,0,0.25)]">
            <h1 class="text-[34px] tracking-wide mb-2 text-center font-semibold">Forgot Password</h1>
            <p class="text-white/60 text-sm text-center mb-8">Enter your email to receive a reset OTP.</p>

            @if (session()->has('status'))
                <div class="p-2.5 rounded mb-5 text-sm bg-green-900/20 text-green-300 border border-green-600">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->has('email'))
                <div class="p-2.5 rounded mb-5 text-sm bg-red-900/20 text-red-300 border border-red-600">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form wire:submit.prevent="sendOtp">
                <div class="mb-6">
                    <label for="email" class="block text-white/90 text-sm font-medium mb-2">Email Address</label>
                    <input type="email"
                           id="email"
                           wire:model="email"
                           placeholder="Enter your email"
                           required
                           class="bg-white/10 border border-white/30 rounded-lg p-3 w-full text-white text-[15px] outline-none transition-all duration-300 focus:border-[#8B1A1A] focus:bg-white/15 placeholder-white/50">
                </div>

                <button type="submit" class="w-full bg-[#8B1A1A] text-white px-8 py-3 rounded-lg font-medium transition-all duration-300 ease-in-out cursor-pointer border-none hover:bg-[#a52323] hover:shadow-lg">
                    Send OTP
                </button>

                <div class="text-center mt-6">
                    <a href="{{ route('login') }}" class="text-white/70 no-underline text-sm hover:text-[#fed136] transition-colors">
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </main>

    <style>
        body:has(main[style*="background-image"]) {
            background-color: #000;
        }
    </style>

    <livewire:components.footer />
</div>
