@extends('layouts.storefront')

@section('content')
<main class="px-5 py-8 md:px-12">
    <h1 class="text-center text-4xl font-medium md:text-5xl">The Olfactory Collection</h1>
    <p class="mx-auto mb-10 mt-3 max-w-2xl text-center text-stone-600">A curation of liquid narratives inspired from the world's most evocative botanicals.</p>

    <section class="grid gap-7 pb-14 md:grid-cols-3">
        @foreach ($products as $product)
            <article>
                <img src="{{ $brandImages[$product->image_key] ?? $brandImages['hero'] }}" alt="{{ $product->name }}" class="aspect-[4/5] w-full border border-stone-200 object-cover">
                <p class="mt-2 text-[11px] uppercase tracking-[0.12em] text-stone-500">{{ $product->subtitle }}</p>
                <h3 class="mt-1 text-2xl font-medium md:text-3xl">{{ $product->name }}</h3>
                <p class="text-stone-600">{{ $product->description }}</p>
                <div class="mt-3 flex items-center justify-between gap-2">
                    <strong>${{ number_format($product->price, 2) }}</strong>
                    <a href="{{ route('product.show', $product) }}" class="text-[11px] uppercase tracking-[0.08em] text-stone-700 underline">Explore Product</a>
                </div>
            </article>
        @endforeach
    </section>
</main>
@endsection
