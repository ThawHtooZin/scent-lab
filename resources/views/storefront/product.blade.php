@extends('layouts.storefront')

@section('content')
<main class="px-5 py-8 md:px-12 md:pb-16">
    <section class="grid gap-10 md:grid-cols-[1.1fr_1fr] md:gap-10 lg:gap-12 px-64">
        @if ($product->image)
            <img src="/images/products/{{ $product->image }}" alt="Hero bottle" class="max-h-[600px] w-full object-contain">
        @else
            <div class="flex h-[600px] w-full items-center justify-center rounded-3xl border border-stone-200 bg-stone-100 text-stone-500">
                Image will be added soon
            </div>
        @endif
        <div class="max">
            <h1 class="text-5xl font-medium leading-none md:text-6xl lg:text-7xl text-primary-dark">{{ $product->name }}</h1>
            <p class="my-3 text-2xl text-secondary">${{ number_format($product->price, 2) }} — {{ $product->size }}</p>
            <p class="text-sm text-stone-500">Stock available: <span class="font-semibold">{{ $product->stock }}</span></p>
            <p class="text-gray-500">THE STORY</p>
            <br>
            <p class="text-stone-600">{{ $product->description }}</p>
            <div class="my-6 grid gap-3 text-sm md:grid-cols-3">
                <p><span class="text-gray-500">Top</span> <br> <span class="text-xl">{{ $product->top_note }}</span></p>
                <p><span class="text-gray-500">Heart</span> <br> <span class="text-xl">{{ $product->heart_note }}</span></p>
                <p><span class="text-gray-500">Base</span> <br> <span class="text-xl">{{ $product->base_note }}</span></p>
            </div>
            @if ($product->stock > 0)
                <form method="POST" action="{{ route('cart.add', $product) }}" class="flex flex-wrap items-center gap-3">
                    @csrf
                    QUANTITY <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="1" class="w-20 rounded border border-stone-200 px-2 py-2">
                    <button type="submit" class="bg-amber-700 px-4 py-2.5 text-[11px] uppercase tracking-[0.12em] text-white hover:bg-amber-800 w-full">Add to Cart</button>
                </form>
            @else
                <div class="rounded-2xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-700">
                    Sold out — check back soon.
                </div>
            @endif
        </div>
    </section>

    <section class="mt-14">
        <h2 class="text-3xl font-medium">The Sourcing</h2>
        <p class="mt-2 max-w-2xl text-stone-600">Every bottle is crafted in small-batch labs and sourced with regenerative partnerships.</p>
    </section>

    <section class="mt-10 grid gap-7 md:grid-cols-3">
        @foreach ($related as $item)
            <article>
                <img src="/images/products/upsell-1.png" alt="Related product" class="aspect-[4/5] w-full border border-stone-200 object-cover">
                <h3 class="mt-2 text-2xl font-medium">{{ $item->name }}</h3>
                <a href="{{ route('product.show', $item) }}" class="mt-2 inline-block text-[11px] uppercase tracking-[0.08em] underline">Explore Product</a>
            </article>
        @endforeach
    </section>
</main>
@endsection
