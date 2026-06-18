<aside style="width: 260px; flex-shrink: 0;">
    <div style="background: #fff; border-radius: 1.25rem; border: 1px solid #e5e7eb; box-shadow: 0 2px 20px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="height: 5px; background: linear-gradient(90deg, #DB4444, #e8704a);"></div>
        <div style="padding: 1.75rem;">
            {{-- User info --}}
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px dashed #e5e7eb;">
                <div style="width: 72px; height: 72px; border-radius: 50%; overflow: hidden; margin-bottom: 0.75rem; box-shadow: 0 0 0 3px #fff, 0 0 0 5px #e5e7eb, 0 4px 12px rgba(0,0,0,0.08);">
                    @if (auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" style="width:100%; height:100%; object-fit: cover;">
                    @else
                        <div style="width:100%; height:100%; background: linear-gradient(135deg,#f5f5f5,#e8e8e8); display:flex; align-items:center; justify-content:center;">
                            <svg style="width:32px; height:32px; color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                    @endif
                </div>
                <p style="font-weight: 700; font-size: 0.875rem; color: #111827;">{{ auth()->user()->name }}</p>
                <p style="font-size: 0.75rem; color: #9ca3af; margin-top: 2px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 100%;">{{ auth()->user()->email }}</p>
            </div>

            {{-- Nav --}}
            <nav style="font-size: 0.875rem;">
                <p style="font-size: 9px; font-weight: 800; color: #d1d5db; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.5rem;">Account</p>
                <a href="{{ route('my-account') }}" style="display:flex; align-items:center; gap: 0.75rem; padding: 0.6rem 0.75rem; border-radius: 0.75rem; font-weight: {{ request()->routeIs('my-account') ? '700' : 'normal' }}; color: {{ request()->routeIs('my-account') ? '#DB4444' : '#6b7280' }}; background: {{ request()->routeIs('my-account') ? 'rgba(219,68,68,0.08)' : 'transparent' }}; margin-bottom: 2px; transition: background 0.2s;" onmouseover="this.style.background='{{ request()->routeIs('my-account') ? 'rgba(219,68,68,0.08)' : '#f9fafb' }}'" onmouseout="this.style.background='{{ request()->routeIs('my-account') ? 'rgba(219,68,68,0.08)' : 'transparent' }}'">
                    <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg> My Profile
                </a>

                <p style="font-size: 9px; font-weight: 800; color: #d1d5db; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.5rem; margin-top: 1rem;">Orders</p>
                <a href="{{ route('my-orders') }}" style="display:flex; align-items:center; gap: 0.75rem; padding: 0.6rem 0.75rem; border-radius: 0.75rem; font-weight: {{ request()->routeIs('my-orders') ? '700' : 'normal' }}; color: {{ request()->routeIs('my-orders') ? '#DB4444' : '#6b7280' }}; background: {{ request()->routeIs('my-orders') ? 'rgba(219,68,68,0.08)' : 'transparent' }}; margin-bottom: 2px; transition: background 0.2s;" onmouseover="this.style.background='{{ request()->routeIs('my-orders') ? 'rgba(219,68,68,0.08)' : '#f9fafb' }}'" onmouseout="this.style.background='{{ request()->routeIs('my-orders') ? 'rgba(219,68,68,0.08)' : 'transparent' }}'">
                    <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg> My Orders
                </a>
                <a href="{{ route('my-reviews') }}" style="display:flex; align-items:center; gap: 0.75rem; padding: 0.6rem 0.75rem; border-radius: 0.75rem; font-weight: {{ request()->routeIs('my-reviews') ? '700' : 'normal' }}; color: {{ request()->routeIs('my-reviews') ? '#DB4444' : '#6b7280' }}; background: {{ request()->routeIs('my-reviews') ? 'rgba(219,68,68,0.08)' : 'transparent' }}; margin-bottom: 2px; transition: background 0.2s;" onmouseover="this.style.background='{{ request()->routeIs('my-reviews') ? 'rgba(219,68,68,0.08)' : '#f9fafb' }}'" onmouseout="this.style.background='{{ request()->routeIs('my-reviews') ? 'rgba(219,68,68,0.08)' : 'transparent' }}'">
                    <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.482-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg> My Reviews
                </a>

                <p style="font-size: 9px; font-weight: 800; color: #d1d5db; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.5rem; margin-top: 1rem;">Wishlist</p>
                <a href="{{ route('my-collection') }}" style="display:flex; align-items:center; gap: 0.75rem; padding: 0.6rem 0.75rem; border-radius: 0.75rem; font-weight: {{ request()->routeIs('my-collection') ? '700' : 'normal' }}; color: {{ request()->routeIs('my-collection') ? '#DB4444' : '#6b7280' }}; background: {{ request()->routeIs('my-collection') ? 'rgba(219,68,68,0.08)' : 'transparent' }}; transition: background 0.2s;" onmouseover="this.style.background='{{ request()->routeIs('my-collection') ? 'rgba(219,68,68,0.08)' : '#f9fafb' }}'" onmouseout="this.style.background='{{ request()->routeIs('my-collection') ? 'rgba(219,68,68,0.08)' : 'transparent' }}'">
                    <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg> My Collection
                </a>
            </nav>
        </div>
    </div>
</aside>
