<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 — Forbidden | Athletiq</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black font-sans antialiased">
    <div class="flex min-h-screen flex-col items-center justify-center px-4 text-center">

        <p class="text-sm font-black uppercase tracking-widest text-white/40">Error 403</p>
        <h1 class="mt-4 text-8xl font-black uppercase text-white sm:text-9xl">403</h1>
        <p class="mt-4 text-xl font-black uppercase text-white/70">Access denied.</p>
        <p class="mt-3 max-w-md text-sm text-white/40">
            You don't have permission to access this page.
        </p>

        <div class="mt-10 flex flex-wrap justify-center gap-4">
            <a href="{{ url('/') }}"
               class="rounded-full bg-white px-7 py-3 text-sm font-black uppercase text-black transition hover:bg-gray-200">
                Back to Home
            </a>
            @auth
                <a href="{{ url('/products') }}"
                   class="rounded-full border border-white/30 px-7 py-3 text-sm font-black uppercase text-white transition hover:bg-white hover:text-black">
                    Shop Products
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="rounded-full border border-white/30 px-7 py-3 text-sm font-black uppercase text-white transition hover:bg-white hover:text-black">
                    Login
                </a>
            @endauth
        </div>

        <p class="mt-20 text-xs font-black uppercase tracking-widest text-white/20">Athletiq</p>
    </div>
</body>
</html>