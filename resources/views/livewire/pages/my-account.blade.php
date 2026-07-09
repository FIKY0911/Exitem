<div class="flex flex-col min-h-screen bg-[#faf8f5]">
    <livewire:components.navbar />

    <main class="py-10 sm:py-14 flex-1">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-8">

            <p class="text-[11px] tracking-[0.15em] uppercase text-gray-400 mb-6 sm:mb-10 font-semibold">
                Home <span class="mx-1.5 text-gray-300">/</span> <span class="text-[#DB4444]">My Account</span>
            </p>

            {{-- OUTER FLEX ROW --}}
            <div class="flex flex-col lg:flex-row gap-6 lg:gap-8 items-start">

                {{-- SIDEBAR --}}
                <x-account-sidebar />

                {{-- MAIN CONTENT --}}
                <div class="flex-1 min-w-0 flex flex-col gap-4 sm:gap-6 w-full">

                    {{-- Edit Profile Card --}}
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-[0_2px_20px_rgba(0,0,0,0.05)] overflow-hidden">
                        <div class="h-[5px] bg-gradient-to-r from-[#DB4444] to-[#e8704a]"></div>
                        <div class="p-5 sm:p-8 lg:p-10">
                            <div class="flex items-center gap-3 mb-6 sm:mb-8">
                                <div class="w-1 h-6 rounded-full bg-[#DB4444]"></div>
                                <h2 class="text-base sm:text-lg font-extrabold text-gray-900">Edit Your Profile</h2>
                            </div>

                            <form wire:submit.prevent="updateProfile">
                                @if (session()->has('message'))
                                    <div class="mb-6 px-4 py-3.5 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-3">
                                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ session('message') }}
                                    </div>
                                @endif

                                @if (session()->has('status'))
                                    <div class="mb-6 px-4 py-3.5 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-3">
                                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ session('status') }}
                                    </div>
                                @endif

                                {{-- Avatar --}}
                                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4 sm:gap-6 mb-6 sm:mb-8 pb-6 sm:pb-8 border-b border-dashed border-gray-200">
                                    <div class="group relative w-20 h-20 sm:w-[88px] sm:h-[88px] rounded-full overflow-hidden shrink-0 cursor-pointer shadow-[0_0_0_3px_#fff,0_0_0_5px_#e5e7eb,0_4px_14px_rgba(0,0,0,0.1)] transition-transform duration-300 hover:scale-105">
                                        @if ($avatar)
                                            <img src="{{ $avatar->temporaryUrl() }}" class="w-full h-full object-cover">
                                        @elseif ($existingAvatar)
                                            <img src="{{ asset('storage/' . $existingAvatar) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            </div>
                                        @endif
                                        <label for="avatarUpload" class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center gap-1 text-white opacity-0 transition-opacity duration-200 cursor-pointer hover:opacity-100">
                                            <svg class="w-5 h-5 sm:w-[22px] sm:h-[22px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            <span class="text-[9px] font-extrabold tracking-[0.1em]">CHANGE</span>
                                        </label>
                                        <input type="file" id="avatarUpload" wire:model="avatar" class="hidden" accept="image/*">
                                    </div>
                                    <div class="text-center sm:text-left">
                                        <h3 class="font-bold text-sm sm:text-[0.95rem] text-gray-800">Profile Photo</h3>
                                        <p class="text-xs sm:text-[0.8rem] text-gray-400 mt-1 leading-relaxed">Hover the photo to change.<br>JPG, PNG or WEBP &mdash; max 2MB.</p>
                                        @if ($avatar)
                                            <p class="text-xs text-green-700 font-semibold mt-2">&check; Image ready to upload</p>
                                        @endif
                                        @error('avatar') <p class="text-xs text-[#DB4444] font-semibold mt-1.5">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                {{-- Fields grid --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
                                    @php
                                        $inp = "block w-full p-3 sm:p-[0.8rem_1rem] text-sm text-gray-900 bg-[#faf8f5] border-2 border-gray-200 rounded-xl outline-none transition-[border-color,background] duration-200 focus:border-[#DB4444] focus:bg-white placeholder-gray-400";
                                    @endphp
                                    <div>
                                        <label class="block text-[10px] font-extrabold text-gray-500 uppercase tracking-[0.15em] mb-2">Full Name</label>
                                        <input type="text" wire:model="name" placeholder="Your full name" class="{{ $inp }}">
                                        @error('name') <p class="text-[0.72rem] text-[#DB4444] font-semibold mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-extrabold text-gray-500 uppercase tracking-[0.15em] mb-2">Email Address</label>
                                        <input type="email" wire:model="email" placeholder="your@email.com" class="{{ $inp }}">
                                        @error('email') <p class="text-[0.72rem] text-[#DB4444] font-semibold mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label class="block text-[10px] font-extrabold text-gray-500 uppercase tracking-[0.15em] mb-2">Phone Number</label>
                                        <input type="text" wire:model="phone" placeholder="08xx-xxxx-xxxx" class="{{ $inp }} max-w-md">
                                        @error('phone') <p class="text-[0.72rem] text-[#DB4444] font-semibold mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row justify-end items-stretch sm:items-center gap-3">
                                    <button type="button" class="px-5 py-2.5 text-sm font-semibold text-gray-500 bg-transparent border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-200 hover:bg-gray-50 hover:text-gray-900">Cancel</button>
                                    <button type="submit" class="px-6 sm:px-8 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-[#DB4444] to-[#e8704a] border-none rounded-xl cursor-pointer shadow-[0_4px_14px_rgba(219,68,68,0.35)] transition-all duration-200 whitespace-nowrap hover:-translate-y-0.5 hover:shadow-[0_6px_20px_rgba(219,68,68,0.5)]">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Password Card --}}
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-[0_2px_20px_rgba(0,0,0,0.05)] overflow-hidden">
                        <div class="h-[5px] bg-gradient-to-r from-gray-600 to-gray-800"></div>
                        <div class="p-5 sm:p-8 lg:p-10">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-1 h-6 rounded-full bg-gray-600"></div>
                                <h2 class="text-base sm:text-lg font-extrabold text-gray-900">Reset Password</h2>
                            </div>

                            @if (session()->has('password_message'))
                                <div class="mb-6 px-4 py-3.5 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-3">
                                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ session('password_message') }}
                                </div>
                            @endif

                            @if (session()->has('password_error'))
                                <div class="mb-6 px-4 py-3.5 bg-red-50 border border-red-200 text-red-800 rounded-xl text-sm flex items-center gap-3">
                                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ session('password_error') }}
                                </div>
                            @endif

                            <p class="text-gray-500 text-sm leading-relaxed mb-6">
                                Click the button below to receive a password reset link via email. The link will be sent to <strong class="text-gray-900">{{ auth()->user()->email }}</strong>
                            </p>

                            <button wire:click="sendResetLink" type="button" class="px-6 sm:px-8 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-gray-600 to-gray-800 border-none rounded-xl cursor-pointer shadow-[0_4px_14px_rgba(45,55,72,0.3)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_6px_20px_rgba(45,55,72,0.45)]">Send Reset Link</button>
                        </div>
                    </div>

                </div>{{-- end main --}}
            </div>{{-- end flex row --}}
        </div>
    </main>

    <livewire:components.footer />
</div>
