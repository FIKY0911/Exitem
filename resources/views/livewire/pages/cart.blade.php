<div class="flex flex-col min-h-screen">
    <livewire:components.navbar />

    <main style="max-width:1170px; margin:0 auto; padding:40px 20px; flex:1; width:100%;">

        {{-- Breadcrumb --}}
        <p style="font-size:13px; color:#7D8184; margin-bottom:32px;">
            <a href="{{ route('home') }}" style="color:#7D8184;">Home</a>
            &nbsp;/&nbsp;
            <span style="color:#000;">Cart</span>
        </p>

        @if(session('cart_added'))
        <div style="margin-bottom:16px; padding:12px 16px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:6px; font-size:13px; color:#166534;">
            "{{ session('cart_added') }}" berhasil ditambahkan ke keranjang!
        </div>
        @endif

        @if(empty($items))
        <div style="text-align:center; padding:80px 0;">
            <svg style="width:64px;height:64px;margin:0 auto 16px;color:#ccc;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <p style="font-size:16px; margin-bottom:16px; color:#888;">Keranjang masih kosong</p>
            <a href="{{ route('home') }}" style="background:#DB4444; color:#fff; padding:12px 24px; border-radius:4px; font-size:14px; text-decoration:none;">
                Lanjut Belanja
            </a>
        </div>
        @else

        {{-- Header Row --}}
        <div style="display:grid; grid-template-columns:2fr 1fr 1fr 1fr; gap:16px; padding:14px 20px; background:#fff; box-shadow:0 1px 4px rgba(0,0,0,0.08); border-radius:4px; margin-bottom:12px; font-size:14px; font-weight:600;">
            <div>Product</div>
            <div style="text-align:center;">Price</div>
            <div style="text-align:center;">Quantity</div>
            <div style="text-align:right;">Subtotal</div>
        </div>

        {{-- Items --}}
        @foreach($items as $item)
        <div style="display:grid; grid-template-columns:2fr 1fr 1fr 1fr; gap:16px; align-items:center; padding:16px 20px; background:#fff; box-shadow:0 1px 4px rgba(0,0,0,0.06); border-radius:4px; margin-bottom:10px;">

            {{-- Product --}}
            <div style="display:flex; align-items:center; gap:12px;">
                <form method="POST" action="{{ route('cart.remove', $item['product_id']) }}" style="flex-shrink:0;">
                    @csrf
                    <button type="submit" style="width:22px;height:22px;background:#DB4444;color:#fff;border:none;border-radius:50%;cursor:pointer;font-size:14px;line-height:1;display:flex;align-items:center;justify-content:center;">×</button>
                </form>
                <div style="width:60px;height:60px;background:#F5F5F5;border-radius:4px;overflow:hidden;flex-shrink:0;">
                    <img src="{{ asset('storage/' . $item['thumbnail']) }}"
                         alt="{{ $item['name'] }}"
                         style="width:100%;height:100%;object-fit:contain;padding:4px;">
                </div>
                <a href="{{ route('product.detail', $item['slug']) }}"
                   style="font-size:13px;color:#333;text-decoration:none;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                    {{ $item['name'] }}
                </a>
            </div>

            {{-- Price --}}
            <div style="text-align:center;font-size:13px;color:#666;">
                Rp {{ number_format($item['price'], 0, ',', '.') }}
            </div>

            {{-- Quantity +/- --}}
            <div style="display:flex;justify-content:center;">
                <div style="display:flex;align-items:center;border:1px solid rgba(0,0,0,0.2);border-radius:4px;overflow:hidden;">
                    <form method="POST" action="{{ route('cart.update', $item['product_id']) }}">
                        @csrf
                        <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                        <button type="submit" style="width:34px;height:36px;background:#fff;border:none;cursor:pointer;font-size:18px;color:#333;">−</button>
                    </form>
                    <span style="width:36px;text-align:center;font-weight:600;font-size:14px;">{{ $item['quantity'] }}</span>
                    <form method="POST" action="{{ route('cart.update', $item['product_id']) }}">
                        @csrf
                        <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                        <button type="submit" style="width:34px;height:36px;background:#DB4444;border:none;cursor:pointer;font-size:18px;color:#fff;">+</button>
                    </form>
                </div>
            </div>

            {{-- Subtotal --}}
            <div style="text-align:right;font-size:14px;font-weight:600;color:#DB4444;">
                Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
            </div>
        </div>
        @endforeach

        {{-- Bottom --}}
        <div style="display:flex;flex-wrap:wrap;justify-content:space-between;align-items:flex-start;gap:24px;margin-top:32px;">

            {{-- Buttons --}}
            <div style="display:flex;gap:12px;flex-wrap:wrap;">
                <a href="{{ route('home') }}"
                   style="padding:12px 24px;border:1px solid #000;border-radius:4px;font-size:13px;text-decoration:none;color:#000;background:#fff;transition:0.2s;"
                   onmouseover="this.style.background='#000';this.style.color='#fff'"
                   onmouseout="this.style.background='#fff';this.style.color='#000'">
                    Return To Shop
                </a>
                <a href="{{ route('cart') }}"
                   style="padding:12px 24px;border:1px solid #000;border-radius:4px;font-size:13px;text-decoration:none;color:#000;background:#fff;transition:0.2s;"
                   onmouseover="this.style.background='#000';this.style.color='#fff'"
                   onmouseout="this.style.background='#fff';this.style.color='#000'">
                    Update Cart
                </a>
            </div>

            {{-- Cart Total --}}
            <div style="width:320px;border:1px solid #ddd;border-radius:4px;padding:24px;">
                <h3 style="font-size:16px;font-weight:600;margin-bottom:20px;">Cart Total</h3>

                <div style="display:flex;justify-content:space-between;font-size:13px;padding:12px 0;border-bottom:1px solid #eee;">
                    <span>Subtotal:</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:13px;padding:12px 0;border-bottom:1px solid #eee;">
                    <span>Shipping:</span>
                    <span style="font-weight:600;">Free</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:14px;font-weight:600;padding:12px 0;">
                    <span>Total:</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>

                <a href="{{ route('checkout') }}"
                   style="display:block;width:100%;margin-top:16px;padding:12px;background:#DB4444;color:#fff;text-align:center;border-radius:4px;font-size:14px;text-decoration:none;font-weight:500;">
                    Proceed to Checkout
                </a>
            </div>
        </div>

        @endif
    </main>

    <livewire:components.footer />
</div>
