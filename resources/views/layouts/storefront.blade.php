<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Scent Lab</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-50 font-serif text-stone-800 antialiased">
    <header class="flex flex-wrap items-center justify-between gap-4 border-b border-stone-200 bg-white/90 px-5 py-4 md:px-12">
        <a href="{{ route('home') }}" class="text-2xl italic text-stone-900 md:text-3xl">The Scent Lab</a>
        <nav class="flex flex-wrap gap-5 text-[11px] uppercase tracking-[0.12em] text-stone-600">
            <a href="{{ route('home') }}" class="hover:text-stone-900">Journal</a>
            <a href="{{ route('shop') }}" class="hover:text-stone-900">Shop</a>
            <a href="{{ route('home') }}#story" class="hover:text-stone-900">Our Story</a>
            <a href="{{ route('cart') }}" class="hover:text-stone-900">Cart</a>
            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-stone-900">Dashboard</a>
            @endauth
        </nav>
    </header>

    @if (session('status'))
        <p class="mx-5 mt-2 rounded border border-green-200 bg-green-50 px-3 py-2 text-sm md:mx-12">{{ session('status') }}</p>
    @endif

    @yield('content')

    <footer class="mt-auto flex flex-col gap-4 border-t border-stone-200 bg-white px-5 py-8 md:flex-row md:items-center md:justify-between md:px-12">
        <p class="text-lg italic text-stone-900">The Scent Lab</p>
        <div class="flex flex-wrap gap-5 text-[11px] uppercase tracking-[0.1em] text-stone-600">
            <a href="#" class="hover:text-stone-900">Privacy Policy</a>
            <a href="#" class="hover:text-stone-900">Shipping & Returns</a>
            <a href="#" class="hover:text-stone-900">Sustainability</a>
            <a href="#" class="hover:text-stone-900">Contact</a>
        </div>
    </footer>
</body>
</html>
