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
    <body class="bg-black font-sans text-brand antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center px-4 py-10">
            <a href="{{ url('/') }}" class="mb-8 text-3xl font-black uppercase text-white">Athletiq</a>

            <div class="w-full max-w-md rounded-lg bg-white p-8 shadow-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
