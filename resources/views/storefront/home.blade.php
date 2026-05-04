@extends('layouts.storefront')

@section('content')
    <main>
        <section class="grid items-center gap-10 px-5 py-10 md:grid-cols-2 md:gap-12 md:px-12 md:pb-16">
            <div>
                <p class="text-[11px] uppercase tracking-[0.14em] text-primary">The Alchemist's Journal</p>
                <h1 class="my-3 text-4xl font-medium leading-tight md:text-5xl lg:text-6xl text-secondary">
                    Luxury is a Feeling,<br><em>Not a Price Tag.</em>
                </h1>
                <p class="text-secondary">At The Scent Lab, we stripped away lofty towers and sourced directly from artisans
                    to make sophisticated scents for everyone.</p>
                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <a class="inline-block bg-amber-700 px-4 py-2.5 text-[11px] uppercase tracking-[0.12em] text-white hover:bg-amber-800"
                        href="{{ route('shop') }}">Discover the Story</a>
                    <a class="text-[11px] uppercase tracking-[0.1em] text-primary underline"
                        href="{{ route('shop') }}">Explore Boutique</a>
                </div>
            </div>
            <img src="/images/scent-lab/hero-bottle.jpg" alt="Hero bottle" class="h-auto max-h-[520px] w-full object-scale-down">
        </section>

        <section class="grid gap-5 px-4 pb-10 md:grid-cols-4 md:px-8">
            @foreach ($featured as $product)
                <article class="p-3 border border-stone-200 rounded-lg">
                    <img src="/images/products/{{ $product->image }}" alt="{{ $product->name }}"
                        class="aspect-[4/5] w-full object-cover rounded-md">
                    <h3 class="mt-2 text-lg font-medium md:text-xl">{{ $product->name }}</h3>
                    <p class="text-sm text-stone-600">{{ $product->description }}</p>
                    <a class="mt-2 inline-block bg-amber-700 px-3 py-2 text-[10px] uppercase tracking-[0.12em] text-white hover:bg-amber-800"
                        href="{{ route('product.show', $product) }}">Discover</a>
                </article>
            @endforeach
        </section>

        <section
            class="mt-8 flex flex-col items-start justify-between gap-8 bg-rose-100/80 px-5 py-10 md:flex-row md:items-center md:px-12"
            id="story">
            <div>
                <h2 class="text-3xl md:text-4xl"><em>Science of Happy.</em></h2>
                <p class="mt-2 text-stone-600">Citrus and floral notes are tiny mood-shifters for your day.</p>
            </div>
            <div class="flex gap-3">
                <img src="/images/scent-lab/science-1.jpg" alt=""
                    class="h-40 w-40 border border-stone-200 object-cover md:h-44 md:w-44">
                <img src="/images/scent-lab/science-2.jpg" alt=""
                    class="h-40 w-40 border border-stone-200 object-cover md:h-44 md:w-44">
            </div>
        </section>
    </main>
@endsection
