@extends('layouts.storefront')

@section('content')
<main class="px-5 py-8 md:px-12 md:pb-16">
    <h1 class="mb-8 text-5xl italic md:text-6xl lg:text-7xl">Your Selection</h1>
    <section class="grid gap-10 lg:grid-cols-[2fr_1fr]">
        <div class="space-y-3">
            @forelse ($items as $item)
                <article class="flex flex-wrap items-start gap-4 border border-stone-200 bg-white p-4">
                    <img src="/images/products/hero-bottle.jpg" alt="Hero bottle" class="h-24 w-24 shrink-0 border border-stone-100 object-cover">
                    <div class="min-w-0 flex-1">
                        <h3 class="text-xl font-medium">{{ $item['product']->name }}</h3>
                        <p class="text-sm text-stone-600">{{ $item['product']->subtitle }} | {{ $item['product']->size }}</p>
                        <p class="mt-1 font-medium">${{ number_format($item['line_total'], 2) }}</p>
                    </div>
                    <form method="POST" action="{{ route('cart.update', $item['product']) }}" class="flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="quantity" min="1" value="{{ $item['qty'] }}" class="w-16 rounded border border-stone-200 px-2 py-1 text-sm">
                        <button type="submit" class="bg-amber-700 px-3 py-2 text-[11px] uppercase tracking-wider text-white hover:bg-amber-800">Update</button>
                    </form>
                    <form method="POST" action="{{ route('cart.remove', $item['product']) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-[11px] uppercase tracking-wider text-stone-600 underline">Remove</button>
                    </form>
                </article>
            @empty
                <p class="text-stone-600">Your cart is empty.</p>
            @endforelse
        </div>
        <aside class="h-fit border border-stone-200 bg-white p-5">
            <h2 class="text-sm font-semibold uppercase tracking-wider">Order Summary</h2>
            <p class="mt-4 flex justify-between text-sm"><span>Subtotal</span><span>${{ number_format($subtotal, 2) }}</span></p>
            <p class="mt-2 flex justify-between text-sm"><span>Tax</span><span>${{ number_format($tax, 2) }}</span></p>
            <p class="mt-4 flex justify-between border-t border-stone-200 pt-4 text-lg"><strong>Total</strong><strong>${{ number_format($total, 2) }}</strong></p>
            <button type="button" class="mt-4 w-full bg-amber-700 py-3 text-[11px] uppercase tracking-[0.12em] text-white hover:bg-amber-800">Secure Checkout</button>
        </aside>
    </section>
</main>
@endsection
