<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Scent Lab</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col min-h-screen bg-stone-50 font-serif text-stone-800 antialiased">
    <!-- Header: shrink-0 ensures it keeps its height -->
    <header class="shrink-0 flex flex-wrap items-center justify-between gap-4 border-b border-stone-200 bg-white/90 px-5 py-4 md:px-12">
        <a href="{{ route('home') }}" class="text-2xl italic md:text-3xl font-['Noto Serif'] text-primary">
            THE SCENT LAB
        </a>
        
        <nav class="flex flex-wrap items-center gap-5 text-[13px] uppercase tracking-[0.12em] text-secondary">
            @php
                $links = [
                    ['route' => 'home', 'label' => 'Home'],
                    ['route' => 'shop', 'label' => 'Shop'],
                    ['route' => 'scent-match.create', 'label' => 'Scent Match'],
                    ['route' => 'home', 'label' => 'Our Story', 'hash' => '#story'],
                ];
            @endphp

            @foreach($links as $link)
                <a href="{{ route($link['route']) }}{{ $link['hash'] ?? '' }}"
                    class="relative py-1 transition-colors duration-300 hover:text-primary-dark group">
                    {{ $link['label'] }}
                    <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-primary-dark transition-all duration-300 group-hover:w-full"></span>
                </a>
            @endforeach

            <!-- Cart Icon Link -->
            <a href="{{ route('cart') }}" class="group relative inline-block ml-2">
                <img src="/images/scent-lab/shopping-bag.svg" alt="Cart"
                    class="w-5 transition-opacity duration-300 group-hover:opacity-0">
                <img src="/images/scent-lab/shopping-bag-hover.svg" alt="Cart Hover"
                    class="w-5 absolute top-0 left-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
            </a>

            @if(auth()->check() && auth()->user()->is_admin)
                <a href="{{ route('dashboard') }}"
                    class="relative py-1 transition-colors duration-300 hover:text-primary-dark group">
                    Dashboard
                    <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-primary-dark transition-all duration-300 group-hover:w-full"></span>
                </a>
            @endif

            @if(session('order_email'))
                <a href="{{ route('orders.index') }}"
                    class="relative py-1 transition-colors duration-300 hover:text-primary-dark group">
                    Orders
                    <span class="absolute bottom-0 left-0 w-0 h-[1px] bg-primary-dark transition-all duration-300 group-hover:w-full"></span>
                </a>
            @endif
        </nav>
    </header>

    @if (session('status'))
        <div class="shrink-0 px-5 md:px-12 mt-2">
            <p class="rounded border border-green-200 bg-green-50 px-3 py-2 text-sm">
                {{ session('status') }}
            </p>
        </div>
    @endif

    <!-- Main Content: flex-grow expands to fill all available space -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer: shrink-0 keeps it at its natural size at the bottom -->
    <footer class="shrink-0 flex flex-col gap-4 border-t border-stone-200 bg-white px-5 py-8 md:flex-row md:items-center md:justify-between md:px-12">
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