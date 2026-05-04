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
            <img src="/images/scent-lab/hero-bottle.jpg" alt="Hero bottle"
                class="h-auto max-h-[520px] w-full object-scale-down">
        </section>

        <section class="grid gap-5 px-4 pb-10 md:grid-cols-3 lg:grid-cols-4 md:px-8">
            @foreach ($featured as $product)
                <article class="p-3 border border-stone-200 rounded-lg flex flex-col justify-between">
                    <div>
                        <img src="/images/products/{{ $product->image }}" alt="{{ $product->name }}"
                            class="aspect-[4/5] w-full object-cover rounded-md">
                        <h3 class="mt-2 text-lg font-medium md:text-xl text-primary">{{ $product->name }}</h3>
                        <p class="text-sm text-secondary">{{ $product->description }}</p>
                    </div>

                    <div class="grid grid-cols-2 items-center gap-4 mt-4">
                        <p class="text-[14px] font-semibold text-primary-dark whitespace-nowrap">
                            {{ $product->price }} MMK
                        </p>
                        <a class="bg-amber-700 px-3 py-2 text-[10px] uppercase tracking-wider text-white text-center rounded-md transition-colors hover:bg-amber-800"
                            href="{{ route('product.show', $product) }}">
                            Discover
                        </a>
                    </div>
                </article>
            @endforeach
        </section>

        <section
            class="mt-12 flex flex-col items-center justify-between gap-12 bg-rose-100/80 px-8 py-16 md:flex-row md:px-20"
            id="story">
            <div class="md:max-w-4xl">
                <h2 class="text-3xl font-light leading-tight lg:text-6xl xl:text-8xl text-secondary">
                    Science of Happy.
                </h2>
                <p class="mt-4 text-lg md:text-xl text-secondary-light leading-relaxed">
                    Citrus and floral notes aren't just smells—they are bio-hacks for your brain. Explore how our olfactory blends boost mood and focus through botanical precision.
                </p>
            </div>

            <div class="flex gap-4 md:gap-6">
                <img src="/images/scent-lab/science-1.jpg" alt="Scent details"
                    class="h-48 w-40 rounded-xl border border-white/50 object-cover shadow-sm lg:h-64 lg:w-48 xl:h-96 xl:w-72">
                <img src="/images/scent-lab/science-2.jpg" alt="Scent experience"
                    class="h-48 w-40 rounded-xl border border-white/50 object-cover shadow-sm lg:h-64 lg:w-48 xl:h-96 xl:w-72 mt-8">
            </div>
        </section>
    </main>
@endsection