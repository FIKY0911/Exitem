<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exitem</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    {{ $slot }}
    @livewireScripts

    <script>
    /**
     * Helper: kirim POST request dengan CSRF, update badge navbar secara real-time,
     * lalu dispatch Livewire event supaya Navbar component juga re-render.
     */
    function _postAndRefresh(url, badgeAttr, livewireEvent, buttonEl, successText) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        // Visual feedback on button
        const originalContent = buttonEl ? buttonEl.innerHTML : null;
        if (buttonEl) {
            buttonEl.style.pointerEvents = 'none';
            buttonEl.innerHTML = '<span style="opacity:0.7">Adding...</span>';
        }

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        })
        .then(res => res.json())
        .then(data => {
            const count = data.count ?? 0;

            // ── 1. Update badge DOM elements directly (instant) ──────────────────
            document.querySelectorAll('[data-' + badgeAttr + ']').forEach(badge => {
                if (count > 0) {
                    badge.textContent = count;
                    badge.style.display = 'flex';
                } else {
                    badge.style.display = 'none';
                }
            });

            // ── 2. Dispatch Livewire event so Navbar component re-renders ────────
            if (typeof Livewire !== 'undefined') {
                Livewire.dispatch(livewireEvent);
            }

            // ── 3. Visual feedback: show checkmark briefly ───────────────────────
            if (buttonEl) {
                buttonEl.innerHTML = successText || '<span style="color:#22c55e;">✓ Added!</span>';
                setTimeout(() => {
                    buttonEl.innerHTML = originalContent;
                    buttonEl.style.pointerEvents = '';
                }, 1500);
            }
        })
        .catch(err => {
            console.error('Request failed:', err);
            if (buttonEl) {
                buttonEl.innerHTML = originalContent;
                buttonEl.style.pointerEvents = '';
            }
        });
    }

    /**
     * addToCart(url, buttonElement)
     * Dipanggil dari onclick di product card / product detail.
     */
    window.addToCart = function(url, buttonEl) {
        _postAndRefresh(
            url,
            'cart-count',
            'cart-updated',
            buttonEl,
            '<span style="color:#22c55e;">✓ Added!</span>'
        );
    };

    /**
     * addToWishlist(url, buttonElement)
     * Dipanggil dari onclick di product card (ikon hati).
     */
    window.addToWishlist = function(url, buttonEl) {
        _postAndRefresh(
            url,
            'wishlist-count',
            'wishlist-updated',
            buttonEl,
            '<span style="color:#ef4444;">♥</span>'
        );
    };
    </script>
</body>
</html>
