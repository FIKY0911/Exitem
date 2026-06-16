<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Exclusive E-Commerce' }}</title>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex flex-col min-h-screen">
        {{ $slot }}

        <script>
        const csrfToken = '{{ csrf_token() }}';

        function addToWishlist(url, btn) {
            btn.style.color = '#DB4444';
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(r => r.json())
            .then(data => {
                document.querySelectorAll('[data-wishlist-count]').forEach(el => {
                    el.textContent = data.count;
                    el.style.display = data.count > 0 ? 'flex' : 'none';
                });
            });
        }

        function addToCart(url, el) {
            const original = el.innerHTML;
            el.innerHTML = '✓ Added';
            el.style.background = '#333';

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(r => r.json())
            .then(data => {
                // Update all cart counters on page
                document.querySelectorAll('[data-cart-count]').forEach(el => {
                    el.textContent = data.count;
                    el.style.display = data.count > 0 ? 'flex' : 'none';
                });
                setTimeout(() => {
                    el.innerHTML = original;
                    el.style.background = '';
                }, 1500);
            });
        }
        </script>
    </body>
</html>
