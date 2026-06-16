<div class="flex flex-col min-h-screen" style="background: #faf8f5;">
    <livewire:components.navbar />

    <main style="padding: 3.5rem 0; flex: 1;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">

            <p style="font-size: 11px; letter-spacing: 0.15em; text-transform: uppercase; color: #9ca3af; margin-bottom: 2.5rem; font-weight: 600;">
                Home <span style="margin: 0 0.5rem; color: #d1d5db;">/</span> <span style="color: #DB4444;">My Account</span>
            </p>

            {{-- OUTER FLEX ROW --}}
            <div style="display: flex; gap: 2rem; align-items: flex-start;">

                {{-- SIDEBAR --}}
                <aside style="width: 260px; flex-shrink: 0;">
                    <div style="background: #fff; border-radius: 1.25rem; border: 1px solid #e5e7eb; box-shadow: 0 2px 20px rgba(0,0,0,0.05); overflow: hidden;">
                        <div style="height: 5px; background: linear-gradient(90deg, #DB4444, #e8704a);"></div>
                        <div style="padding: 1.75rem;">
                            {{-- User info --}}
                            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px dashed #e5e7eb;">
                                <div style="width: 72px; height: 72px; border-radius: 50%; overflow: hidden; margin-bottom: 0.75rem; box-shadow: 0 0 0 3px #fff, 0 0 0 5px #e5e7eb, 0 4px 12px rgba(0,0,0,0.08);">
                                    @if ($existingAvatar)
                                        <img src="{{ asset('storage/' . $existingAvatar) }}" style="width:100%; height:100%; object-fit: cover;">
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
                                <a href="{{ route('my-account') }}" style="display:flex; align-items:center; gap: 0.75rem; padding: 0.6rem 0.75rem; border-radius: 0.75rem; font-weight: 700; color: #DB4444; background: rgba(219,68,68,0.08); margin-bottom: 2px;">
                                    <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg> My Profile
                                </a>
                                <a href="#" style="display:flex; align-items:center; gap: 0.75rem; padding: 0.6rem 0.75rem; border-radius: 0.75rem; color: #6b7280; margin-bottom: 2px; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                                    <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg> Address Book
                                </a>
                                <a href="#" style="display:flex; align-items:center; gap: 0.75rem; padding: 0.6rem 0.75rem; border-radius: 0.75rem; color: #6b7280; margin-bottom: 12px; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                                    <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg> Payment Options
                                </a>

                                <p style="font-size: 9px; font-weight: 800; color: #d1d5db; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.5rem;">Orders</p>
                                <a href="{{ route('my-orders') }}" style="display:flex; align-items:center; gap: 0.75rem; padding: 0.6rem 0.75rem; border-radius: 0.75rem; color: #6b7280; margin-bottom: 2px;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                                    <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg> My Returns
                                </a>
                                <a href="{{ route('my-orders') }}" style="display:flex; align-items:center; gap: 0.75rem; padding: 0.6rem 0.75rem; border-radius: 0.75rem; color: #6b7280; margin-bottom: 12px;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                                    <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg> My Cancellations
                                </a>

                                <p style="font-size: 9px; font-weight: 800; color: #d1d5db; text-transform: uppercase; letter-spacing: 0.2em; margin-bottom: 0.5rem;">Wishlist</p>
                                <a href="{{ route('my-collection') }}" style="display:flex; align-items:center; gap: 0.75rem; padding: 0.6rem 0.75rem; border-radius: 0.75rem; color: #6b7280;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='transparent'">
                                    <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg> My Collection
                                </a>
                            </nav>
                        </div>
                    </div>
                </aside>

                {{-- MAIN CONTENT --}}
                <div style="flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 1.5rem;">

                    {{-- Edit Profile Card --}}
                    <div style="background: #fff; border-radius: 1.25rem; border: 1px solid #e5e7eb; box-shadow: 0 2px 20px rgba(0,0,0,0.05); overflow: hidden;">
                        <div style="height: 5px; background: linear-gradient(90deg, #DB4444, #e8704a);"></div>
                        <div style="padding: 2.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem;">
                                <div style="width: 4px; height: 24px; border-radius: 9999px; background: #DB4444;"></div>
                                <h2 style="font-size: 1.125rem; font-weight: 800; color: #111827;">Edit Your Profile</h2>
                            </div>

                            <form wire:submit.prevent="updateProfile">
                                @if (session()->has('message'))
                                    <div style="margin-bottom: 1.5rem; padding: 0.875rem 1rem; background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; border-radius: 0.75rem; font-size: 0.875rem; display: flex; align-items: center; gap: 0.75rem;">
                                        <svg style="width:20px;height:20px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ session('message') }}
                                    </div>
                                @endif

                                {{-- Avatar --}}
                                <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 1px dashed #e5e7eb;">
                                    <div class="group" style="position: relative; width: 88px; height: 88px; border-radius: 50%; overflow: hidden; flex-shrink: 0; cursor: pointer; box-shadow: 0 0 0 3px #fff, 0 0 0 5px #e5e7eb, 0 4px 14px rgba(0,0,0,0.1); transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        @if ($avatar)
                                            <img src="{{ $avatar->temporaryUrl() }}" style="width:100%;height:100%;object-fit:cover;">
                                        @elseif ($existingAvatar)
                                            <img src="{{ asset('storage/' . $existingAvatar) }}" style="width:100%;height:100%;object-fit:cover;">
                                        @else
                                            <div style="width:100%;height:100%;background:linear-gradient(135deg,#f5f5f5,#e8e8e8);display:flex;align-items:center;justify-content:center;">
                                                <svg style="width:40px;height:40px;color:#9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            </div>
                                        @endif
                                        <label for="avatarUpload" style="position:absolute;inset:0;background:rgba(0,0,0,0.5);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:4px;color:#fff;opacity:0;transition:opacity 0.2s;cursor:pointer;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                                            <svg style="width:22px;height:22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            <span style="font-size:9px;font-weight:800;letter-spacing:0.1em;">CHANGE</span>
                                        </label>
                                        <input type="file" id="avatarUpload" wire:model="avatar" style="display:none;" accept="image/*">
                                    </div>
                                    <div>
                                        <h3 style="font-weight: 700; color: #1f2937; font-size: 0.95rem;">Profile Photo</h3>
                                        <p style="font-size: 0.8rem; color: #9ca3af; margin-top: 4px; line-height: 1.5;">Hover the photo to change.<br>JPG, PNG or WEBP — max 2MB.</p>
                                        <div wire:loading wire:target="avatar" style="display:flex;align-items:center;gap:6px;color:#DB4444;font-size:0.75rem;font-weight:700;margin-top:8px;">
                                            <svg style="animation:spin 1s linear infinite;width:14px;height:14px;" fill="none" viewBox="0 0 24 24"><circle style="opacity:0.25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path style="opacity:0.75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                            Uploading...
                                        </div>
                                        @if ($avatar)
                                            <p wire:loading.remove wire:target="avatar" style="font-size:0.75rem;color:#15803d;font-weight:600;margin-top:8px;">✓ Image ready</p>
                                        @endif
                                        @error('avatar') <p style="font-size:0.75rem;color:#DB4444;font-weight:600;margin-top:6px;">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                {{-- Fields grid --}}
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                                    <div>
                                        <label style="display:block;font-size:10px;font-weight:800;color:#6b7280;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:0.5rem;">Full Name</label>
                                        <input type="text" wire:model="name" placeholder="Your full name"
                                               style="display:block;width:100%;padding:0.8rem 1rem;font-size:0.875rem;color:#111827;background:#faf8f5;border:1.5px solid #e5e7eb;border-radius:0.75rem;outline:none;box-sizing:border-box;transition:border-color 0.2s,background 0.2s;"
                                               onfocus="this.style.borderColor='#DB4444';this.style.background='#fff';"
                                               onblur="this.style.borderColor='#e5e7eb';this.style.background='#faf8f5';">
                                        @error('name') <p style="font-size:0.72rem;color:#DB4444;font-weight:600;margin-top:4px;">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label style="display:block;font-size:10px;font-weight:800;color:#6b7280;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:0.5rem;">Email Address</label>
                                        <input type="email" wire:model="email" placeholder="your@email.com"
                                               style="display:block;width:100%;padding:0.8rem 1rem;font-size:0.875rem;color:#111827;background:#faf8f5;border:1.5px solid #e5e7eb;border-radius:0.75rem;outline:none;box-sizing:border-box;transition:border-color 0.2s,background 0.2s;"
                                               onfocus="this.style.borderColor='#DB4444';this.style.background='#fff';"
                                               onblur="this.style.borderColor='#e5e7eb';this.style.background='#faf8f5';">
                                        @error('email') <p style="font-size:0.72rem;color:#DB4444;font-weight:600;margin-top:4px;">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label style="display:block;font-size:10px;font-weight:800;color:#6b7280;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:0.5rem;">Phone Number</label>
                                        <input type="text" wire:model="phone" placeholder="08xx-xxxx-xxxx"
                                               style="display:block;width:100%;padding:0.8rem 1rem;font-size:0.875rem;color:#111827;background:#faf8f5;border:1.5px solid #e5e7eb;border-radius:0.75rem;outline:none;box-sizing:border-box;transition:border-color 0.2s,background 0.2s;"
                                               onfocus="this.style.borderColor='#DB4444';this.style.background='#fff';"
                                               onblur="this.style.borderColor='#e5e7eb';this.style.background='#faf8f5';">
                                        @error('phone') <p style="font-size:0.72rem;color:#DB4444;font-weight:600;margin-top:4px;">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div style="display:flex;justify-content:flex-end;align-items:center;gap:0.75rem;">
                                    <button type="button" style="padding:0.65rem 1.5rem;font-size:0.875rem;font-weight:600;color:#6b7280;background:transparent;border:1.5px solid #e5e7eb;border-radius:0.75rem;cursor:pointer;transition:all 0.2s;" onmouseover="this.style.background='#f9fafb';this.style.color='#111827';" onmouseout="this.style.background='transparent';this.style.color='#6b7280';">Cancel</button>
                                    <button type="submit" style="padding:0.65rem 2rem;font-size:0.875rem;font-weight:700;color:#fff;background:linear-gradient(135deg,#DB4444,#e8704a);border:none;border-radius:0.75rem;cursor:pointer;box-shadow:0 4px 14px rgba(219,68,68,0.35);transition:all 0.2s;white-space:nowrap;" onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 6px 20px rgba(219,68,68,0.5)';" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 14px rgba(219,68,68,0.35)';">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Password Card --}}
                    <div style="background: #fff; border-radius: 1.25rem; border: 1px solid #e5e7eb; box-shadow: 0 2px 20px rgba(0,0,0,0.05); overflow: hidden;">
                        <div style="height: 5px; background: linear-gradient(90deg, #4a5568, #2d3748);"></div>
                        <div style="padding: 2.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 2rem;">
                                <div style="width: 4px; height: 24px; border-radius: 9999px; background: #4a5568;"></div>
                                <h2 style="font-size: 1.125rem; font-weight: 800; color: #111827;">Password Changes</h2>
                            </div>

                            <form wire:submit.prevent="updatePassword">
                                @if (session()->has('password_message'))
                                    <div style="margin-bottom: 1.5rem; padding: 0.875rem 1rem; background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; border-radius: 0.75rem; font-size: 0.875rem; display:flex;align-items:center;gap:0.75rem;">
                                        <svg style="width:20px;height:20px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ session('password_message') }}
                                    </div>
                                @endif

                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                                    <div>
                                        <label style="display:block;font-size:10px;font-weight:800;color:#6b7280;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:0.5rem;">Current Password</label>
                                        <input type="password" wire:model="current_password" placeholder="••••••••"
                                               style="display:block;width:100%;padding:0.8rem 1rem;font-size:0.875rem;color:#111827;background:#faf8f5;border:1.5px solid #e5e7eb;border-radius:0.75rem;outline:none;box-sizing:border-box;transition:border-color 0.2s,background 0.2s;"
                                               onfocus="this.style.borderColor='#4a5568';this.style.background='#fff';"
                                               onblur="this.style.borderColor='#e5e7eb';this.style.background='#faf8f5';">
                                        @error('current_password') <p style="font-size:0.72rem;color:#DB4444;font-weight:600;margin-top:4px;">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label style="display:block;font-size:10px;font-weight:800;color:#6b7280;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:0.5rem;">New Password</label>
                                        <input type="password" wire:model="new_password" placeholder="Min. 8 characters"
                                               style="display:block;width:100%;padding:0.8rem 1rem;font-size:0.875rem;color:#111827;background:#faf8f5;border:1.5px solid #e5e7eb;border-radius:0.75rem;outline:none;box-sizing:border-box;transition:border-color 0.2s,background 0.2s;"
                                               onfocus="this.style.borderColor='#4a5568';this.style.background='#fff';"
                                               onblur="this.style.borderColor='#e5e7eb';this.style.background='#faf8f5';">
                                        @error('new_password') <p style="font-size:0.72rem;color:#DB4444;font-weight:600;margin-top:4px;">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label style="display:block;font-size:10px;font-weight:800;color:#6b7280;text-transform:uppercase;letter-spacing:0.15em;margin-bottom:0.5rem;">Confirm New Password</label>
                                        <input type="password" wire:model="new_password_confirmation" placeholder="Re-enter new password"
                                               style="display:block;width:100%;padding:0.8rem 1rem;font-size:0.875rem;color:#111827;background:#faf8f5;border:1.5px solid #e5e7eb;border-radius:0.75rem;outline:none;box-sizing:border-box;transition:border-color 0.2s,background 0.2s;"
                                               onfocus="this.style.borderColor='#4a5568';this.style.background='#fff';"
                                               onblur="this.style.borderColor='#e5e7eb';this.style.background='#faf8f5';">
                                    </div>
                                </div>

                                <div style="display:flex;justify-content:flex-end;">
                                    <button type="submit" style="padding:0.65rem 2rem;font-size:0.875rem;font-weight:700;color:#fff;background:linear-gradient(135deg,#4a5568,#2d3748);border:none;border-radius:0.75rem;cursor:pointer;box-shadow:0 4px 14px rgba(45,55,72,0.3);transition:all 0.2s;" onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 6px 20px rgba(45,55,72,0.45)';" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 14px rgba(45,55,72,0.3)';">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>{{-- end main --}}
            </div>{{-- end flex row --}}
        </div>
    </main>

    <livewire:components.footer />
</div>
