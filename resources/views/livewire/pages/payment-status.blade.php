<div class="flex flex-col min-h-screen" style="background: linear-gradient(135deg, #0f0f0f 0%, #1a1a2e 50%, #16213e 100%); font-family: 'Inter', sans-serif;">

    {{-- Animated background particles --}}
    <div style="position:fixed; inset:0; overflow:hidden; pointer-events:none; z-index:0;">
        <div class="particle" style="position:absolute; width:300px; height:300px; border-radius:50%; background:radial-gradient(circle, rgba(219,68,68,0.15) 0%, transparent 70%); top:-100px; right:-100px; animation:float 8s ease-in-out infinite;"></div>
        <div class="particle" style="position:absolute; width:200px; height:200px; border-radius:50%; background:radial-gradient(circle, rgba(99,102,241,0.12) 0%, transparent 70%); bottom:100px; left:-50px; animation:float 10s ease-in-out infinite reverse;"></div>
    </div>

    <style>
        @keyframes float { 0%,100%{transform:translateY(0) scale(1)} 50%{transform:translateY(-30px) scale(1.05)} }
        @keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }
        @keyframes pulse-ring { 0%{transform:scale(0.8);opacity:1} 100%{transform:scale(2);opacity:0} }
        @keyframes bounce-in { 0%{transform:scale(0.3);opacity:0} 60%{transform:scale(1.05)} 80%{transform:scale(0.95)} 100%{transform:scale(1);opacity:1} }
        @keyframes slide-up { from{transform:translateY(30px);opacity:0} to{transform:translateY(0);opacity:1} }
        @keyframes shimmer { 0%{background-position:-200% 0} 100%{background-position:200% 0} }
        .status-card { animation: bounce-in 0.6s cubic-bezier(0.175,0.885,0.32,1.275) forwards; }
        .slide-up { animation: slide-up 0.5s ease forwards; }
        .spinner { animation: spin 1s linear infinite; }
        .shimmer {
            background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.08) 50%, transparent 100%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
    </style>

    <main style="position:relative; z-index:1; flex:1; display:flex; align-items:center; justify-content:center; padding:40px 20px; min-height:100vh;">
        <div style="width:100%; max-width:520px;">

            {{-- ── PENDING / LOADING ── --}}
            @if($status === 'pending')
            <div class="status-card" style="background:rgba(255,255,255,0.05); backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,0.1); border-radius:24px; padding:48px 40px; text-align:center;">

                {{-- Spinner ring --}}
                <div style="position:relative; width:100px; height:100px; margin:0 auto 32px;">
                    <div style="position:absolute; inset:0; border-radius:50%; border:3px solid rgba(255,255,255,0.05);"></div>
                    <div class="spinner" style="position:absolute; inset:0; border-radius:50%; border:3px solid transparent; border-top-color:#DB4444; border-right-color:#f97316;"></div>
                    <div style="position:absolute; inset:12px; border-radius:50%; background:rgba(219,68,68,0.1); display:flex; align-items:center; justify-content:center;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#DB4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/>
                        </svg>
                    </div>
                </div>

                <h1 style="font-size:24px; font-weight:700; color:#fff; margin-bottom:12px;">Waiting for Payment</h1>
                <p style="color:rgba(255,255,255,0.55); font-size:15px; line-height:1.6; margin-bottom:32px;">
                    We're waiting for confirmation from your payment provider.<br>
                    This page updates automatically every 2 seconds.
                </p>

                {{-- Order info --}}
                @if($productName)
                <div class="slide-up" style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); border-radius:14px; padding:20px; margin-bottom:28px; text-align:left;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                        <span style="font-size:12px; color:rgba(255,255,255,0.4); text-transform:uppercase; letter-spacing:0.5px;">Order</span>
                        <span style="font-size:12px; color:#DB4444; font-weight:600; background:rgba(219,68,68,0.1); padding:2px 10px; border-radius:20px;">{{ $orderId }}</span>
                    </div>
                    <p style="color:#fff; font-weight:600; font-size:15px; margin-bottom:4px;">{{ $productName }}</p>
                    <p style="color:rgba(255,255,255,0.5); font-size:13px;">Qty: {{ $quantity }}</p>
                    @if($amount)
                    <p style="color:#f97316; font-weight:700; font-size:18px; margin-top:10px;">Rp {{ number_format($amount, 0, ',', '.') }}</p>
                    @endif
                </div>
                @endif

                {{-- Pulsing dots --}}
                <div style="display:flex; justify-content:center; gap:6px;">
                    @foreach([0, 150, 300] as $delay)
                    <div style="width:8px; height:8px; border-radius:50%; background:#DB4444; animation:pulse-ring 1.5s ease-out {{ $delay }}ms infinite;"></div>
                    @endforeach
                </div>
            </div>

            {{-- ── SUCCESS ── --}}
            @elseif($status === 'paid')
            <div class="status-card" style="background:rgba(255,255,255,0.05); backdrop-filter:blur(20px); border:1px solid rgba(34,197,94,0.3); border-radius:24px; padding:48px 40px; text-align:center;">

                {{-- Success icon with glow --}}
                <div style="position:relative; width:110px; height:110px; margin:0 auto 32px;">
                    <div style="position:absolute; inset:-10px; border-radius:50%; background:radial-gradient(circle, rgba(34,197,94,0.3) 0%, transparent 70%);"></div>
                    <div style="position:absolute; inset:0; border-radius:50%; background:linear-gradient(135deg, #22c55e, #16a34a); display:flex; align-items:center; justify-content:center; box-shadow:0 0 40px rgba(34,197,94,0.4);">
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                    </div>
                </div>

                <h1 style="font-size:28px; font-weight:800; color:#fff; margin-bottom:10px;">Payment Successful! 🎉</h1>
                <p style="color:rgba(255,255,255,0.6); font-size:15px; margin-bottom:32px;">
                    Your order has been confirmed and is being processed.
                </p>

                {{-- Order detail card --}}
                @if($productName)
                <div class="slide-up" style="background:rgba(34,197,94,0.08); border:1px solid rgba(34,197,94,0.2); border-radius:14px; padding:20px; margin-bottom:28px; text-align:left;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <span style="font-size:12px; color:rgba(255,255,255,0.4); text-transform:uppercase; letter-spacing:0.5px;">Order Confirmed</span>
                        <span style="font-size:12px; color:#22c55e; font-weight:600; background:rgba(34,197,94,0.1); padding:2px 10px; border-radius:20px;">{{ $orderId }}</span>
                    </div>
                    <p style="color:#fff; font-weight:600; font-size:16px; margin-bottom:4px;">{{ $productName }}</p>
                    <p style="color:rgba(255,255,255,0.5); font-size:13px; margin-bottom:10px;">Qty: {{ $quantity }}</p>
                    @if($amount)
                    <div style="display:flex; justify-content:space-between; align-items:center; padding-top:12px; border-top:1px solid rgba(255,255,255,0.06);">
                        <span style="color:rgba(255,255,255,0.5); font-size:13px;">Total Paid</span>
                        <span style="color:#22c55e; font-weight:700; font-size:18px;">Rp {{ number_format($amount, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    @if($paymentType)
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:8px;">
                        <span style="color:rgba(255,255,255,0.5); font-size:13px;">Method</span>
                        <span style="color:rgba(255,255,255,0.7); font-size:13px; font-weight:500;">{{ str_replace('_', ' ', ucwords($paymentType)) }}</span>
                    </div>
                    @endif
                </div>
                @endif

                <div style="display:flex; flex-direction:column; gap:12px;">
                    <a href="{{ route('my-orders') }}"
                       style="display:block; width:100%; padding:15px; background:linear-gradient(135deg,#22c55e,#16a34a); color:#fff; border:none; border-radius:12px; font-size:15px; font-weight:700; text-decoration:none; text-align:center; box-shadow:0 4px 20px rgba(34,197,94,0.3); transition:transform 0.2s;"
                       onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                        View My Orders
                    </a>
                    <a href="{{ route('home') }}"
                       style="display:block; width:100%; padding:14px; background:rgba(255,255,255,0.06); color:rgba(255,255,255,0.7); border:1px solid rgba(255,255,255,0.1); border-radius:12px; font-size:14px; font-weight:500; text-decoration:none; text-align:center; transition:all 0.2s;"
                       onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.06)'">
                        Continue Shopping
                    </a>
                </div>
            </div>

            {{-- ── FAILED ── --}}
            @elseif(in_array($status, ['failed', 'expired', 'cancelled']))
            <div class="status-card" style="background:rgba(255,255,255,0.05); backdrop-filter:blur(20px); border:1px solid rgba(239,68,68,0.3); border-radius:24px; padding:48px 40px; text-align:center;">

                <div style="position:relative; width:110px; height:110px; margin:0 auto 32px;">
                    <div style="position:absolute; inset:-10px; border-radius:50%; background:radial-gradient(circle, rgba(239,68,68,0.3) 0%, transparent 70%);"></div>
                    <div style="position:absolute; inset:0; border-radius:50%; background:linear-gradient(135deg,#ef4444,#b91c1c); display:flex; align-items:center; justify-content:center; box-shadow:0 0 40px rgba(239,68,68,0.4);">
                        <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </div>
                </div>

                <h1 style="font-size:28px; font-weight:800; color:#fff; margin-bottom:10px;">
                    @if($status === 'expired') Payment Expired ⏰
                    @else Payment Failed ❌
                    @endif
                </h1>
                <p style="color:rgba(255,255,255,0.6); font-size:15px; margin-bottom:32px;">
                    @if($status === 'expired')
                        Your payment session has expired. Please place a new order.
                    @else
                        Your payment could not be processed. Please try again.
                    @endif
                </p>

                <div style="background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.2); border-radius:14px; padding:16px; margin-bottom:28px;">
                    <p style="color:rgba(255,255,255,0.7); font-size:13px;">Order ID: <span style="color:#ef4444; font-weight:600;">{{ $orderId }}</span></p>
                </div>

                <div style="display:flex; flex-direction:column; gap:12px;">
                    <a href="{{ route('checkout') }}"
                       style="display:block; width:100%; padding:15px; background:linear-gradient(135deg,#ef4444,#b91c1c); color:#fff; border:none; border-radius:12px; font-size:15px; font-weight:700; text-decoration:none; text-align:center; box-shadow:0 4px 20px rgba(239,68,68,0.3); transition:transform 0.2s;"
                       onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                        Try Again
                    </a>
                    <a href="{{ route('home') }}"
                       style="display:block; width:100%; padding:14px; background:rgba(255,255,255,0.06); color:rgba(255,255,255,0.7); border:1px solid rgba(255,255,255,0.1); border-radius:12px; font-size:14px; font-weight:500; text-decoration:none; text-align:center;"
                       onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.06)'">
                        Back to Home
                    </a>
                </div>
            </div>

            {{-- ── NOT FOUND ── --}}
            @else
            <div class="status-card" style="background:rgba(255,255,255,0.05); backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,0.1); border-radius:24px; padding:48px 40px; text-align:center;">
                <div style="font-size:64px; margin-bottom:20px;">🔍</div>
                <h1 style="font-size:24px; font-weight:700; color:#fff; margin-bottom:12px;">Order Not Found</h1>
                <p style="color:rgba(255,255,255,0.5); font-size:15px; margin-bottom:28px;">We couldn't find payment information for this order.</p>
                <a href="{{ route('home') }}"
                   style="display:inline-block; padding:14px 32px; background:#DB4444; color:#fff; border-radius:10px; font-weight:600; text-decoration:none;">
                    Back to Home
                </a>
            </div>
            @endif

        </div>
    </main>
</div>
