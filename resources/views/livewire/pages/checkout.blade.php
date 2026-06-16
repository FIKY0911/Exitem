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
                <h2 style="font-size:20px; font-weight:700; margin-bottom:28px; color:#111;">Billing Details</h2>

                @php
                    $inp = "width:100%; padding:13px 16px; border:1.5px solid #e8e8e8; border-radius:8px; font-size:14px; color:#222; background:#fff; outline:none; box-sizing:border-box; transition:border 0.2s;";
                    $lbl = "display:block; font-size:12px; font-weight:600; color:#666; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;";
                    $err = "font-size:11px; color:#DB4444; margin-top:5px;";
                @endphp

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

                <label style="display:flex; align-items:center; gap:10px; font-size:13px; color:#555; cursor:pointer; margin-bottom:32px;">
                    <input wire:model="save_info" type="checkbox" style="width:15px;height:15px;accent-color:#DB4444;">
                    Save this information for faster check-out next time
                </label>

                {{-- Payment Method --}}
                <div>
                    <h3 style="font-size:14px; font-weight:700; color:#111; margin-bottom:16px; text-transform:uppercase; letter-spacing:0.5px;">
                        Payment Method <span style="color:#DB4444;">*</span>
                    </h3>

                    <div style="display:flex; flex-direction:column; gap:10px;">
                        @foreach(['bank_transfer' => 'Bank Transfer', 'cod' => 'Cash on Delivery', 'qris' => 'QRIS'] as $val => $label)
                        <label style="display:flex; justify-content:space-between; align-items:center; padding:14px 18px;
                                      border:1.5px solid {{ $payment === $val ? '#DB4444' : '#e8e8e8' }};
                                      border-radius:8px; cursor:pointer; font-size:14px; color:#333;
                                      background:{{ $payment === $val ? '#fff8f8' : '#fff' }};
                                      transition:all 0.2s;">
                            <span style="font-weight:{{ $payment === $val ? '600' : '400' }};">{{ $label }}</span>
                            <input wire:model.live="payment" type="radio" value="{{ $val }}"
                                   style="width:16px;height:16px;accent-color:#DB4444;">
                        </label>
                        @endforeach
                    </div>

                    @if($payment === 'bank_transfer')
                    <div style="margin-top:12px; background:#f9f9f9; border:1px solid #e8e8e8; border-radius:8px; padding:16px; font-size:13px; line-height:2;">
                        <p style="font-weight:600; margin-bottom:4px; color:#333;">Transfer to:</p>
                        <p>🏦 BCA — <code style="background:#eee;padding:2px 6px;border-radius:3px;">1234567890</code> &nbsp;ExItem Store</p>
                        <p>🏦 Mandiri — <code style="background:#eee;padding:2px 6px;border-radius:3px;">0987654321</code> &nbsp;ExItem Store</p>
                        <p>🏦 BRI — <code style="background:#eee;padding:2px 6px;border-radius:3px;">1122334455</code> &nbsp;ExItem Store</p>
                    </div>
                    @endif

                    @error('payment') <p style="{{ $err }} margin-top:8px;">{{ $message }}</p> @enderror
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
    </main>

    <livewire:components.footer />
</div>
