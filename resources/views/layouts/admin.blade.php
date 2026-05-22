<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Admin') - {{ config('app.name', 'Athletiq') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white font-sans text-gray-950 antialiased">
        <x-admin.sidebar />

        <div class="ml-60 min-h-screen">
            <header class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-gray-200 bg-white px-8">
                <div>
                    <p class="text-xs font-bold uppercase text-gray-400">Admin Panel</p>
                    <h1 class="text-2xl font-black uppercase">@yield('title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-3">
                    <div class="grid h-10 w-10 place-items-center rounded-full bg-black text-sm font-bold uppercase text-white">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold">{{ auth()->user()->name ?? 'Admin' }}</p>
                        <p class="text-xs uppercase text-gray-400">Administrator</p>
                    </div>
                </div>
            </header>

            <main class="p-8">
                @yield('content')
                {{ $slot ?? '' }}
            </main>
        </div>
    </body>
</html>
