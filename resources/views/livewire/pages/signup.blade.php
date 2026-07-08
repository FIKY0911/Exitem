<div>
    <livewire:components.navbar :dark="false" />

    <!-- Auth Page dengan Tailwind -->
    <main class="bg-transparent bg-cover bg-center bg-no-repeat text-white min-h-screen flex items-center justify-center font-['Poppins']" style="background-image: url('/storage/background-auth/image-auth.webp');">
        <!-- Auth Container -->
        <div class="bg-black/45 backdrop-blur-sm rounded-[20px] p-14 w-full max-w-[450px] shadow-[0_10px_28px_rgba(0,0,0,0.25)]">
            <h1 class="text-[34px] tracking-wide mb-8 text-center font-semibold">Sign Up</h1>
            
            @if ($errors->any())
                <div class="p-2.5 rounded mb-5 text-sm bg-red-900/20 text-red-300 border border-red-600">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form wire:submit.prevent="signup" autocomplete="off">
                @csrf
                
                <!-- Full Name Field -->
                <div class="mb-6">
                    <label for="name" class="block text-white/90 text-sm font-medium mb-2">Full Name</label>
                    <input type="text" 
                           id="name"
                           wire:model="name" 
                           placeholder="Enter your full name" 
                           required
                           class="bg-white/10 border border-white/30 rounded-lg p-3 w-full text-white text-[15px] outline-none transition-all duration-300 focus:border-[#8B1A1A] focus:bg-white/15 placeholder-white/50">
                </div>
                
                <!-- Phone Number Field -->
                <div class="mb-6">
                    <label for="phone" class="block text-white/90 text-sm font-medium mb-2">Phone Number</label>
                    <input type="text" 
                           id="phone"
                           wire:model="phone" 
                           placeholder="e.g. 08123456789" 
                           required
                           class="bg-white/10 border border-white/30 rounded-lg p-3 w-full text-white text-[15px] outline-none transition-all duration-300 focus:border-[#8B1A1A] focus:bg-white/15 placeholder-white/50">
                </div>
                
                <!-- Email Field -->
                <div class="mb-6">
                    <label for="email" class="block text-white/90 text-sm font-medium mb-2">Email Address</label>
                    <input type="email" 
                           id="email"
                           wire:model="identifier" 
                           placeholder="Enter your email" 
                           required
                           class="bg-white/10 border border-white/30 rounded-lg p-3 w-full text-white text-[15px] outline-none transition-all duration-300 focus:border-[#8B1A1A] focus:bg-white/15 placeholder-white/50">
                </div>
                
                <!-- Password Field -->
                <div class="mb-6 relative" x-data="{ show: false }">
                    <label for="password" class="block text-white/90 text-sm font-medium mb-2">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" 
                               id="password"
                               wire:model="password" 
                               placeholder="Min. 8 characters" 
                               required 
                               class="w-full pr-12 bg-white/10 border border-white/30 rounded-lg p-3 text-white text-[15px] outline-none transition-all duration-300 focus:border-[#8B1A1A] focus:bg-white/15 placeholder-white/50">
                        <button type="button" 
                                @click="show = !show" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-200 transition-colors focus:outline-none">
                            <!-- Eye Icon (Show) -->
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- Eye Slash Icon (Hide) -->
                            <svg x-show="show" x-cloak style="display: none;" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.51-2.936m2.53-2.53A10.05 10.05 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 01-1.51 2.936m-2.53 2.53A10.05 10.05 0 0112 19M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-8">
                    <button type="submit" class="w-full sm:w-auto bg-[#8B1A1A] text-white px-8 py-3 rounded-lg font-medium transition-all duration-300 ease-in-out cursor-pointer border-none hover:bg-[#a52323] hover:shadow-lg">
                        Create Account
                    </button>
                    <a href="{{ route('login') }}" class="text-white/70 no-underline text-sm hover:text-[#fed136] transition-colors">
                        Already have an account?
                    </a>
                </div>
            </form>
        </div>
    </main>

    <!-- Background fix for body -->
    <style>
        body:has(main[style*="background-image"]) {
            background-color: #000;
        }
    </style>

    <livewire:components.footer />
</div>
