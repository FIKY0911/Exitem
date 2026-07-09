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
            buttonEl.innerHTML = '<span style="opacity:0.7">Loading...</span>';
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
            const action = data.action ?? 'added'; // 'added' or 'removed'

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

            // ── 3. Visual feedback based on action ───────────────────────────────
            if (buttonEl) {
                if (action === 'removed') {
                    // Removed state
                    if (badgeAttr === 'wishlist-count') {
                        buttonEl.innerHTML = '<svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>';
                        buttonEl.classList.remove('bg-[#DB4444]', 'text-white');
                        buttonEl.classList.add('bg-white', 'text-gray-700');
                    } else {
                        buttonEl.innerHTML = originalContent || successText;
                    }
                } else {
                    // Added state
                    if (badgeAttr === 'wishlist-count') {
                        buttonEl.innerHTML = '<svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>';
                        buttonEl.classList.remove('bg-white', 'text-gray-700');
                        buttonEl.classList.add('bg-[#DB4444]', 'text-white');
                    } else {
                        buttonEl.innerHTML = successText || '<span style="color:#22c55e;">✓ Added!</span>';
                        setTimeout(() => {
                            buttonEl.innerHTML = originalContent;
                        }, 1500);
                    }
                }
                buttonEl.style.pointerEvents = '';
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
     * toggleCart(url, buttonElement)
     * Toggle item in cart (add if not exists, remove if exists)
     */
    window.toggleCart = function(url, buttonEl) {
        _postAndRefresh(
            url,
            'cart-count',
            'cart-updated',
            buttonEl,
            '<span style="color:#22c55e;">✓ Added!</span>'
        );
    };

    /**
     * toggleWishlist(url, buttonElement)
     * Toggle item in wishlist (add if not exists, remove if exists)
     */
    window.toggleWishlist = function(url, buttonEl) {
        _postAndRefresh(
            url,
            'wishlist-count',
            'wishlist-updated',
            buttonEl,
            '<span style="color:#ef4444;">♥</span>'
        );
    };

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
