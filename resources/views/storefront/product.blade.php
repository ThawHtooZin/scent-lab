@extends('layouts.storefront')

@section('content')
<main class="px-5 py-8 md:px-12 md:pb-16">
    <section class="mx-auto grid max-w-7xl gap-8 md:grid-cols-[1.15fr_1fr] md:gap-10 lg:gap-12">
        @if ($product->image)
            <img src="/images/products/{{ $product->image }}" alt="{{ $product->name }}" class="max-h-[680px] w-full rounded-2xl object-contain">
        @else
            <div class="flex h-[600px] w-full items-center justify-center rounded-3xl border border-stone-200 bg-stone-100 text-stone-500">
                Image will be added soon
            </div>
        @endif
        <div>
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
                    <button type="submit" class="w-full rounded bg-amber-700 px-4 py-2.5 text-[11px] uppercase tracking-[0.12em] text-white hover:bg-amber-800">Add to Cart</button>
                </form>
            @else
                <div class="rounded-2xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-700">
                    Sold out — check back soon.
                </div>
            @endif
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="mx-auto mt-12 max-w-7xl">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-xl font-medium text-primary-dark md:text-2xl">Related Products</h2>
                <a href="{{ route('shop') }}" class="text-[11px] uppercase tracking-[0.12em] text-stone-600 underline">View all</a>
            </div>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                @foreach ($related as $item)
                    <article class="rounded-xl border border-stone-200 bg-white p-2.5">
                        <img src="/images/products/{{ $item->image }}" alt="{{ $item->name }}" class="aspect-[4/5] w-full rounded-lg object-cover">
                        <h3 class="mt-2 line-clamp-1 text-base font-medium text-secondary">{{ $item->name }}</h3>
                        <p class="text-sm text-stone-600">${{ number_format($item->price, 2) }}</p>
                        <a href="{{ route('product.show', $item) }}" class="mt-1 inline-block text-[10px] uppercase tracking-[0.1em] text-stone-700 underline">Explore</a>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</main>
@endsection
