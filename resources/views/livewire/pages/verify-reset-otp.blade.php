<div>
    <livewire:components.navbar :dark="false" />

    <main class="bg-transparent bg-cover bg-center bg-no-repeat text-white min-h-screen flex items-center justify-center font-['Poppins']" style="background-image: url('/storage/background-auth/image-auth.webp');">
        <div class="bg-black/45 backdrop-blur-sm rounded-[20px] p-14 w-full max-w-[450px] shadow-[0_10px_28px_rgba(0,0,0,0.25)]">
            @if ($step === 'verify')
                <h1 class="text-[34px] tracking-wide mb-2 text-center font-semibold">Verify OTP</h1>
                <p class="text-white/60 text-sm text-center mb-8">Enter the 6-digit OTP sent to <strong>{{ $email }}</strong></p>

                @if ($errors->has('otp'))
                    <div class="p-2.5 rounded mb-5 text-sm bg-red-900/20 text-red-300 border border-red-600">
                        {{ $errors->first('otp') }}
                    </div>
                @endif

                <form wire:submit.prevent="verifyOtp">
                    <div class="mb-6">
                        <label for="otp" class="block text-white/90 text-sm font-medium mb-2">OTP Code</label>
                        <input type="text"
                               id="otp"
                               wire:model="otp"
                               placeholder="000000"
                               maxlength="6"
                               required
                               class="bg-white/10 border border-white/30 rounded-lg p-3 w-full text-white text-[15px] outline-none transition-all duration-300 focus:border-[#8B1A1A] focus:bg-white/15 placeholder-white/50 text-center tracking-[8px]">
                    </div>

                    <button type="submit" class="w-full bg-[#8B1A1A] text-white px-8 py-3 rounded-lg font-medium transition-all duration-300 ease-in-out cursor-pointer border-none hover:bg-[#a52323] hover:shadow-lg">
                        Verify OTP
                    </button>

                    <div class="text-center mt-6">
                        <a href="{{ route('forgot-password') }}" class="text-white/70 no-underline text-sm hover:text-[#fed136] transition-colors">
                            Request new OTP
                        </a>
                    </div>
                </form>
            @else
                <h1 class="text-[34px] tracking-wide mb-2 text-center font-semibold">Reset Password</h1>
                <p class="text-white/60 text-sm text-center mb-8">Enter your new password for <strong>{{ $email }}</strong></p>

                @if ($errors->has('password'))
                    <div class="p-2.5 rounded mb-5 text-sm bg-red-900/20 text-red-300 border border-red-600">
                        {{ $errors->first('password') }}
                    </div>
                @endif

                @if ($errors->has('password_confirmation'))
                    <div class="p-2.5 rounded mb-5 text-sm bg-red-900/20 text-red-300 border border-red-600">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                @endif

                <form wire:submit.prevent="resetPassword">
                    <div class="mb-6">
                        <label for="password" class="block text-white/90 text-sm font-medium mb-2">New Password</label>
                        <input type="password"
                               id="password"
                               wire:model="password"
                               placeholder="Min. 8 characters"
                               required
                               class="bg-white/10 border border-white/30 rounded-lg p-3 w-full text-white text-[15px] outline-none transition-all duration-300 focus:border-[#8B1A1A] focus:bg-white/15 placeholder-white/50">
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-white/90 text-sm font-medium mb-2">Confirm Password</label>
                        <input type="password"
                               id="password_confirmation"
                               wire:model="password_confirmation"
                               placeholder="Confirm your password"
                               required
                               class="bg-white/10 border border-white/30 rounded-lg p-3 w-full text-white text-[15px] outline-none transition-all duration-300 focus:border-[#8B1A1A] focus:bg-white/15 placeholder-white/50">
                    </div>

                    <button type="submit" class="w-full bg-[#8B1A1A] text-white px-8 py-3 rounded-lg font-medium transition-all duration-300 ease-in-out cursor-pointer border-none hover:bg-[#a52323] hover:shadow-lg">
                        Reset Password
                    </button>
                </form>
            @endif
        </div>
    </main>

    <style>
        body:has(main[style*="background-image"]) {
            background-color: #000;
        }
    </style>

    <livewire:components.footer />
</div>
