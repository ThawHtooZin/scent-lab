<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Scent Lab</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-stone-50 font-serif text-stone-800 antialiased">
    <header
        class="flex flex-wrap items-center justify-between gap-4 border-b border-stone-200 bg-white/90 px-5 py-4 md:px-12">
        <a href="{{ route('home') }}" class="text-2xl italic md:text-3xl font-['Noto Serif'] text-primary">THE SCENT
            LAB</a>
        <nav class="flex flex-wrap items-center gap-5 text-[13px] uppercase tracking-[0.12em] text-secondary">
            @php
                $links = [
                    ['route' => 'home', 'label' => 'Journal'],
                    ['route' => 'shop', 'label' => 'Shop'],
                    ['route' => 'home', 'label' => 'Our Story', 'hash' => '#story'],
                ];
            @endphp

            @foreach($links as $link)
                <a href="{{ route($link['route']) }}{{ $link['hash'] ?? '' }}"
                    class="relative py-1 transition-colors duration-300 hover:text-primary-dark group">
                    {{ $link['label'] }}
                    <!-- Custom Underline -->
                    <span
                        class="absolute bottom-0 left-0 w-0 h-[1px] bg-primary-dark transition-all duration-300 group-hover:w-full"></span>
                </a>
            @endforeach

            <!-- Cart Icon Link -->
            <a href="{{ route('cart') }}" class="group relative inline-block ml-2">
                <img src="/images/scent-lab/shopping-bag.svg" alt="Cart"
                    class="w-5 transition-opacity duration-300 group-hover:opacity-0">
                <img src="/images/scent-lab/shopping-bag-hover.svg" alt="Cart Hover"
                    class="w-5 absolute top-0 left-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
            </a>

            @auth
                <a href="{{ route('dashboard') }}"
                    class="relative py-1 transition-colors duration-300 hover:text-primary-dark group">
                    Dashboard
                    <span
                        class="absolute bottom-0 left-0 w-0 h-[1px] bg-primary-dark transition-all duration-300 group-hover:w-full"></span>
                </a>
            @endauth
        </nav>
    </header>

    @if (session('status'))
        <p class="mx-5 mt-2 rounded border border-green-200 bg-green-50 px-3 py-2 text-sm md:mx-12">{{ session('status') }}
        </p>
    @endif

    @yield('content')

    <footer
        class="mt-auto flex flex-col gap-4 border-t border-stone-200 bg-white px-5 py-8 md:flex-row md:items-center md:justify-between md:px-12">
        <p class="text-lg italic text-primary">The Scent Lab</p>
        <div class="flex flex-wrap gap-5 text-[11px] uppercase tracking-[0.1em] text-stone-600">
            <a href="#" class="hover:text-primary">Privacy Policy</a>
            <a href="#" class="hover:text-primary">Shipping & Returns</a>
            <a href="#" class="hover:text-primary">Sustainability</a>
            <a href="#" class="hover:text-primary">Contact</a>
        </div>
    </footer>
</body>

</html>