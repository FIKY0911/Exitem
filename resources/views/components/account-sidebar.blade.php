<aside class="w-full lg:w-[260px] lg:flex-shrink-0">
    {{-- Mobile: horizontal tab nav --}}
    <div class="lg:hidden mb-6 overflow-x-auto scrollbar-hide -mx-5 px-5">
        <div class="flex gap-2 min-w-max pb-2 border-b border-gray-200">
            <a href="{{ route('my-account') }}"
               class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-xs font-semibold whitespace-nowrap transition-colors
                      {{ request()->routeIs('my-account') ? 'bg-[#DB4444] text-white' : 'bg-gray-100 text-[#6b7280] hover:bg-gray-200' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profile
            </a>
            <a href="{{ route('my-orders') }}"
               class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-xs font-semibold whitespace-nowrap transition-colors
                      {{ request()->routeIs('my-orders') ? 'bg-[#DB4444] text-white' : 'bg-gray-100 text-[#6b7280] hover:bg-gray-200' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Orders
            </a>
            <a href="{{ route('my-reviews') }}"
               class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-xs font-semibold whitespace-nowrap transition-colors
                      {{ request()->routeIs('my-reviews') ? 'bg-[#DB4444] text-white' : 'bg-gray-100 text-[#6b7280] hover:bg-gray-200' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.482-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                Reviews
            </a>
            <a href="{{ route('my-collection') }}"
               class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-xs font-semibold whitespace-nowrap transition-colors
                      {{ request()->routeIs('my-collection') ? 'bg-[#DB4444] text-white' : 'bg-gray-100 text-[#6b7280] hover:bg-gray-200' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Collection
            </a>
        </div>
    </div>

    {{-- Desktop: full sidebar --}}
    <div class="hidden lg:block bg-white rounded-2xl border border-gray-200 shadow-[0_2px_20px_rgba(0,0,0,0.05)] overflow-hidden">
        <div class="h-[5px] bg-gradient-to-r from-[#DB4444] to-[#e8704a]"></div>
        <div class="p-7">
            <div class="flex flex-col items-center text-center mb-6 pb-6 border-b border-dashed border-gray-200">
                <div class="w-[72px] h-[72px] rounded-full overflow-hidden mb-3 shadow-[0_0_0_3px_#fff,0_0_0_5px_#e5e7eb,0_4px_12px_rgba(0,0,0,0.08)]">
                    @if (auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                    @endif
                </div>
                <p class="font-bold text-sm text-gray-900">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 mt-0.5 truncate max-w-full">{{ auth()->user()->email }}</p>
            </div>

            <nav class="text-sm space-y-1">
                <p class="text-[9px] font-extrabold text-gray-300 uppercase tracking-[0.2em] mb-2">Account</p>
                <a href="{{ route('my-account') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl font-semibold transition-colors
                          {{ request()->routeIs('my-account') ? 'bg-[rgba(219,68,68,0.08)] text-[#DB4444]' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    My Profile
                </a>

                <p class="text-[9px] font-extrabold text-gray-300 uppercase tracking-[0.2em] mb-2 mt-4">Orders</p>
                <a href="{{ route('my-orders') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors
                          {{ request()->routeIs('my-orders') ? 'bg-[rgba(219,68,68,0.08)] text-[#DB4444] font-semibold' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    My Orders
                </a>
                <a href="{{ route('my-reviews') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors
                          {{ request()->routeIs('my-reviews') ? 'bg-[rgba(219,68,68,0.08)] text-[#DB4444] font-semibold' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.482-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    My Reviews
                </a>

                <p class="text-[9px] font-extrabold text-gray-300 uppercase tracking-[0.2em] mb-2 mt-4">Wishlist</p>
                <a href="{{ route('my-collection') }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors
                          {{ request()->routeIs('my-collection') ? 'bg-[rgba(219,68,68,0.08)] text-[#DB4444] font-semibold' : 'text-gray-500 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    My Collection
                </a>
            </nav>
        </div>
    </div>
</aside>
