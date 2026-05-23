<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Athletiq') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white font-sans text-brand antialiased">
        <x-navbar />

        <main class="min-h-screen">
            @yield('content')
            {{ $slot ?? '' }}
        </main>

        <x-footer />

        {{-- Flash Messages --}}
        <x-flash-message />

        <script>
function toggleWishlist(btn) {
    const productId = btn.getAttribute('data-product-id');
    const url = btn.getAttribute('data-url');
    const csrf = btn.getAttribute('data-csrf');
    const svg = btn.querySelector('svg');
    const isWishlisted = btn.getAttribute('data-wishlisted') === 'true';

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.wishlisted) {
            svg.setAttribute('fill', 'currentColor');
            svg.classList.remove('text-gray-400');
            svg.classList.add('text-red-500');
            btn.setAttribute('data-wishlisted', 'true');
        } else {
            svg.setAttribute('fill', 'none');
            svg.classList.remove('text-red-500');
            svg.classList.add('text-gray-400');
            btn.setAttribute('data-wishlisted', 'false');
        }
    })
    .catch(err => console.error('Wishlist error:', err));
}
</script>
    </body>
</html>
