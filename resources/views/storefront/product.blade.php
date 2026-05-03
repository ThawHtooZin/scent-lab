@extends('layouts.storefront')

@section('content')
<main class="px-5 py-8 md:px-12 md:pb-16">
    <section class="grid gap-10 md:grid-cols-[1.1fr_1fr] md:gap-10 lg:gap-12">
        <img src="{{ $brandImages[$product->image_key] ?? $brandImages['hero'] }}" alt="{{ $product->name }}" class="max-h-[600px] w-full border border-stone-200 object-cover">
        <div>
            <h1 class="text-5xl font-medium leading-none md:text-6xl lg:text-7xl">{{ $product->name }}</h1>
            <p class="my-3 text-2xl text-stone-600">${{ number_format($product->price, 2) }} — {{ $product->size }}</p>
            <p class="text-stone-600">{{ $product->description }}</p>
            <div class="my-6 grid gap-3 text-sm md:grid-cols-3">
                <p><strong>Top</strong> {{ $product->top_note }}</p>
                <p><strong>Heart</strong> {{ $product->heart_note }}</p>
                <p><strong>Base</strong> {{ $product->base_note }}</p>
            </div>
            <form method="POST" action="{{ route('cart.add', $product) }}" class="flex flex-wrap items-center gap-3">
                @csrf
                <input type="number" name="quantity" min="1" value="1" class="w-20 rounded border border-stone-200 px-2 py-2">
                <button type="submit" class="bg-amber-700 px-4 py-2.5 text-[11px] uppercase tracking-[0.12em] text-white hover:bg-amber-800">Add to Cart</button>
            </form>
        </div>
    </section>

    <section class="mt-14">
        <h2 class="text-3xl font-medium">The Sourcing</h2>
        <p class="mt-2 max-w-2xl text-stone-600">Every bottle is crafted in small-batch labs and sourced with regenerative partnerships.</p>
    </section>

    <section class="mt-10 grid gap-7 md:grid-cols-3">
        @foreach ($related as $item)
            <article>
                <img src="{{ $brandImages[$item->image_key] ?? $brandImages['hero'] }}" alt="{{ $item->name }}" class="aspect-[4/5] w-full border border-stone-200 object-cover">
                <h3 class="mt-2 text-2xl font-medium">{{ $item->name }}</h3>
                <a href="{{ route('product.show', $item) }}" class="mt-2 inline-block text-[11px] uppercase tracking-[0.08em] underline">Explore Product</a>
            </article>
        @endforeach
    </section>
</main>
@endsection
