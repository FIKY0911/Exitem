<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        {{ $slot }}

        @livewireScripts

        <script>
        function _postAndRefresh(url, badgeAttr, livewireEvent, buttonEl, successText) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
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
                document.querySelectorAll('[data-' + badgeAttr + ']').forEach(badge => {
                    if (count > 0) {
                        badge.textContent = count;
                        badge.style.display = 'flex';
                    } else {
                        badge.style.display = 'none';
                    }
                });
                if (typeof Livewire !== 'undefined') {
                    Livewire.dispatch(livewireEvent);
                }
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

        window.addToCart = function(url, buttonEl) {
            _postAndRefresh(url, 'cart-count', 'cart-updated', buttonEl, '<span style="color:#22c55e;">✓ Added!</span>');
        };

        window.addToWishlist = function(url, buttonEl) {
            _postAndRefresh(url, 'wishlist-count', 'wishlist-updated', buttonEl, '<span style="color:#ef4444;">♥</span>');
        };
        </script>
    </body>
</html>
