<div class="flex flex-col min-h-screen">
    <livewire:components.navbar />

    <main style="max-width:1170px; margin:0 auto; padding:48px 20px; flex:1; width:100%;">

        {{-- Breadcrumb --}}
        <p style="font-size:13px; color:#aaa; margin-bottom:40px; letter-spacing:0.3px;">
            <a href="{{ route('home') }}" style="color:#aaa; text-decoration:none;">Home</a>
            <span style="margin:0 8px;">›</span>
            <a href="{{ route('cart') }}" style="color:#aaa; text-decoration:none;">Cart</a>
            <span style="margin:0 8px;">›</span>
            <span style="color:#222; font-weight:500;">Checkout</span>
        </p>

        <form wire:submit="placeOrder" style="display:grid; grid-template-columns:1fr 400px; gap:48px; align-items:start;">

            {{-- LEFT --}}
            <div>
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:28px;">
                    <h2 style="font-size:20px; font-weight:700; color:#111;">Billing Details</h2>
                    @if($hasSavedBilling)
                        <span style="display:inline-flex; align-items:center; gap:6px; background:#f0fdf4; border:1px solid #bbf7d0; color:#16a34a; padding:6px 12px; border-radius:20px; font-size:12px; font-weight:600;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            Saved billing loaded
                        </span>
                    @endif
                </div>

                @php
                    $inp = "width:100%; padding:13px 16px; border:1.5px solid #e8e8e8; border-radius:8px; font-size:14px; color:#222; background:#fff; outline:none; box-sizing:border-box; transition:border 0.2s;";
                    $lbl = "display:block; font-size:12px; font-weight:600; color:#666; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;";
                    $err = "font-size:11px; color:#DB4444; margin-top:5px;";
                @endphp

                {{-- Saved billing banner --}}
                @if($hasSavedBilling)
                <div style="background:#fffbeb; border:1.5px solid #fde68a; border-radius:10px; padding:14px 18px; margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; gap:12px;">
                    <div>
                        <p style="font-size:13px; font-weight:600; color:#92400e; margin-bottom:2px;">✅ Using your saved billing information</p>
                        <p style="font-size:12px; color:#a16207;">{{ $first_name }} · {{ $phone }} · {{ $city }}</p>
                    </div>
                    <button type="button" wire:click="clearSavedBilling"
                            style="background:none; border:1.5px solid #fcd34d; border-radius:7px; padding:7px 14px; font-size:12px; font-weight:600; color:#92400e; cursor:pointer; white-space:nowrap; transition:all 0.2s;"
                            onmouseover="this.style.background='#fef3c7'" onmouseout="this.style.background='none'">
                        ✏️ Edit info
                    </button>
                </div>
                @endif

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
                    <div>
                        <label style="{{ $lbl }}">First Name <span style="color:#DB4444;">*</span></label>
                        <input wire:model="first_name" type="text" placeholder="John" style="{{ $inp }}"
                               onfocus="this.style.borderColor='#DB4444'" onblur="this.style.borderColor='#e8e8e8'">
                        @error('first_name') <p style="{{ $err }}">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label style="{{ $lbl }}">Phone <span style="color:#DB4444;">*</span></label>
                        <input wire:model="phone" type="tel" placeholder="+62 8xx xxxx xxxx" style="{{ $inp }}"
                               onfocus="this.style.borderColor='#DB4444'" onblur="this.style.borderColor='#e8e8e8'">
                        @error('phone') <p style="{{ $err }}">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div style="margin-bottom:20px;">
                    <label style="{{ $lbl }}">Street Address <span style="color:#DB4444;">*</span></label>
                    <input wire:model="address" type="text" placeholder="House number and street name" style="{{ $inp }}"
                           onfocus="this.style.borderColor='#DB4444'" onblur="this.style.borderColor='#e8e8e8'">
                    @error('address') <p style="{{ $err }}">{{ $message }}</p> @enderror
                </div>

                <div style="margin-bottom:28px;">
                    <label style="{{ $lbl }}">Town / City <span style="color:#DB4444;">*</span></label>
                    <input wire:model="city" type="text" placeholder="Your city" style="{{ $inp }}"
                           onfocus="this.style.borderColor='#DB4444'" onblur="this.style.borderColor='#e8e8e8'">
                    @error('city') <p style="{{ $err }}">{{ $message }}</p> @enderror
                </div>

                {{-- Save Info checkbox — hide when info is already saved and unchanged --}}
                <label style="display:flex; align-items:center; gap:10px; font-size:13px; color:#555; cursor:pointer; margin-bottom:32px;">
                    <input wire:model="save_info" type="checkbox" style="width:15px;height:15px;accent-color:#DB4444;">
                    @if($hasSavedBilling)
                        Update my saved billing information
                    @else
                        Save this information for faster check-out next time
                    @endif
                </label>

                {{-- Payment Method (Delegated to Midtrans) --}}
                <div style="margin-top:10px; background:#f9f9f9; border:1px solid #e8e8e8; border-radius:8px; padding:16px; font-size:13px; line-height:1.6;">
                    <p style="font-weight:600; color:#333; margin-bottom:4px;">Secure Payment via Midtrans</p>
                    <p style="color:#555;">You will be redirected to our secure payment gateway to choose your preferred payment method (Bank Transfer, GoPay, QRIS, etc) after clicking Place Order.</p>
                </div>
            </div>

            {{-- RIGHT: Order Summary --}}
            <div style="background:#fff; border:1.5px solid #e8e8e8; border-radius:12px; padding:28px; position:sticky; top:100px;">
                <h3 style="font-size:16px; font-weight:700; margin-bottom:24px; color:#111;">Order Summary</h3>

                {{-- Items --}}
                @foreach($items as $item)
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px; padding-bottom:16px; border-bottom:1px solid #f0f0f0;">
                    <div style="width:48px;height:48px;background:#F5F5F5;border-radius:8px;overflow:hidden;flex-shrink:0;">
                        <img src="{{ asset('storage/' . $item['thumbnail']) }}"
                             alt="{{ $item['name'] }}"
                             style="width:100%;height:100%;object-fit:contain;padding:4px;">
                    </div>
                    <div style="flex:1;min-width:0;">
                        <p style="font-size:13px;font-weight:500;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $item['name'] }}</p>
                        <p style="font-size:12px;color:#888;margin-top:2px;">Qty: {{ $item['quantity'] }}</p>
                    </div>
                    <span style="font-size:13px;font-weight:600;color:#111;flex-shrink:0;">
                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                    </span>
                </div>
                @endforeach

                {{-- Totals --}}
                <div style="display:flex;justify-content:space-between;font-size:13px;padding:10px 0;color:#555;">
                    <span>Subtotal</span>
                    <span style="color:#111;">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:13px;padding:10px 0;border-bottom:1px solid #f0f0f0;color:#555;">
                    <span>Shipping</span>
                    <span style="color:#22c55e;font-weight:600;">Free</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:16px;font-weight:700;padding:14px 0;color:#111;">
                    <span>Total</span>
                    <span style="color:#DB4444;">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>

                <button type="submit"
                        style="width:100%;padding:15px;background:#DB4444;color:#fff;border:none;border-radius:8px;font-size:15px;font-weight:600;cursor:pointer;letter-spacing:0.3px;transition:background 0.2s;"
                        onmouseover="this.style.background='#c83333'"
                        onmouseout="this.style.background='#DB4444'">
                    Place Order
                </button>

                <p style="text-align:center;font-size:11px;color:#aaa;margin-top:12px;">
                    🔒 Secure checkout
                </p>
            </div>

        </form>

        {{-- Payment Status Popup --}}
        @if($order_id)
        <div wire:poll.2s="checkPaymentStatus" style="position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); backdrop-filter:blur(4px); display:flex; align-items:center; justify-content:center; z-index:9999;">
            <div style="background:#fff; padding:40px; border-radius:16px; max-width:400px; width:90%; text-align:center; box-shadow:0 20px 40px rgba(0,0,0,0.15);">
                @if($paymentRecord && $paymentRecord->status === 'paid')
                    <div style="width:80px; height:80px; border-radius:50%; background:#e8f5e9; color:#4caf50; display:flex; align-items:center; justify-content:center; margin:0 auto 24px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                    </div>
                    <h2 style="font-size:24px; font-weight:800; color:#111; margin-bottom:12px;">Payment Successful!</h2>
                    <p style="font-size:15px; color:#555; margin-bottom:32px; line-height:1.5;">Thank you for your purchase. Your order has been placed and is currently being processed.</p>
                    <a href="{{ route('home') }}" style="display:block; width:100%; padding:14px; background:#111; color:#fff; font-weight:600; text-decoration:none; border-radius:10px; transition:background 0.2s;" onmouseover="this.style.background='#333'" onmouseout="this.style.background='#111'">Continue Shopping</a>
                @elseif($paymentRecord && in_array($paymentRecord->status, ['failed', 'expired', 'cancelled']))
                    <div style="width:80px; height:80px; border-radius:50%; background:#ffebee; color:#f44336; display:flex; align-items:center; justify-content:center; margin:0 auto 24px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </div>
                    <h2 style="font-size:24px; font-weight:800; color:#111; margin-bottom:12px;">Payment Failed!</h2>
                    <p style="font-size:15px; color:#555; margin-bottom:32px; line-height:1.5;">We could not process your payment. Please try again or use another payment method.</p>
                    <a href="{{ route('checkout') }}" style="display:block; width:100%; padding:14px; background:#DB4444; color:#fff; font-weight:600; text-decoration:none; border-radius:10px; transition:background 0.2s;" onmouseover="this.style.background='#c83333'" onmouseout="this.style.background='#DB4444'">Try Again</a>
                @else
                    <div style="width:80px; height:80px; border-radius:50%; background:#fff3e0; color:#ff9800; display:flex; align-items:center; justify-content:center; margin:0 auto 24px; animation: pulse 2s infinite;">
                        <svg style="animation: spin 1s linear infinite;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2v4m0 12v4M4.93 4.93l2.83 2.83m8.48 8.48l2.83 2.83M2 12h4m12 0h4M4.93 19.07l2.83-2.83m8.48-8.48l2.83-2.83"/></svg>
                        <style>
                            @keyframes spin { 100% { transform: rotate(360deg); } }
                            @keyframes pulse { 0% { box-shadow: 0 0 0 0 rgba(255,152,0,0.4); } 70% { box-shadow: 0 0 0 20px rgba(255,152,0,0); } 100% { box-shadow: 0 0 0 0 rgba(255,152,0,0); } }
                        </style>
                    </div>
                    <h2 style="font-size:24px; font-weight:800; color:#111; margin-bottom:12px;">Waiting for Payment...</h2>
                    <p style="font-size:15px; color:#555; margin-bottom:24px; line-height:1.5;">Please complete your payment. We are waiting for the confirmation from Midtrans.</p>
                    <a href="{{ $paymentRecord ? $paymentRecord->redirect_url : '#' }}" target="_blank" style="display:block; width:100%; padding:14px; background:#ff9800; color:#fff; font-weight:600; text-decoration:none; border-radius:10px; margin-bottom:12px; transition:background 0.2s;" onmouseover="this.style.background='#f57c00'" onmouseout="this.style.background='#ff9800'">Pay Now</a>
                    <a href="{{ route('checkout') }}" style="display:inline-block; font-size:14px; color:#888; text-decoration:underline; font-weight:500;">Close</a>
                @endif
            </div>
        </div>
        @endif
    </main>

    <livewire:components.footer />
</div>
