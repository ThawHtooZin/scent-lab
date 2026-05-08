@extends('layouts.storefront')

@section('content')
    <main>
        @unless(session('order_email'))
            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
                <div class="w-full max-w-xl rounded-3xl bg-white p-8 shadow-2xl">
                    <div class="mb-6 text-center">
                        <p class="text-sm uppercase tracking-[0.2em] text-amber-600">Welcome to The Scent Lab</p>
                        <h2 class="mt-3 text-3xl font-semibold text-stone-900">Stay connected with your order</h2>
                        <p class="mt-2 text-sm text-stone-600">Enter your email now so we can keep your checkout secure and save your orders from the start.</p>
                    </div>
                    <form method="POST" action="{{ route('orders.store') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="redirect_to" value="{{ route('home') }}">
                        <label class="block">
                            <span class="text-sm font-medium text-stone-700">Email address</span>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="mt-1 block w-full rounded border border-stone-200 bg-stone-50 px-3 py-2 text-sm">
                        </label>
                        @error('email')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="w-full rounded bg-amber-700 px-5 py-3 text-sm uppercase tracking-[0.2em] text-white hover:bg-amber-800">
                            Save my email
                        </button>
                    </form>
                </div>
            </div>
        @endunless

        <section class="grid items-center gap-10 px-5 py-10 md:grid-cols-2 md:gap-12 md:px-12 md:pb-16">
            <div data-animate>
                <p class="text-[11px] uppercase tracking-[0.14em] text-primary">The Scent Lab Home</p>
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
            <img data-animate src="/images/scent-lab/hero-bottle.jpg" alt="Hero bottle"
                class="h-auto max-h-[520px] w-full object-scale-down">
        </section>

        <section class="grid gap-5 px-4 pb-10 md:grid-cols-3 lg:grid-cols-4 md:px-8">
            @foreach ($featured as $product)
                <article data-animate class="p-3 border border-stone-200 rounded-lg flex flex-col justify-between">
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

        <section data-animate class="mx-4 mt-12 overflow-hidden rounded-3xl border border-amber-200/70 bg-gradient-to-r from-amber-100 via-rose-50 to-white md:mx-8">
            <div class="grid gap-6 p-6 md:grid-cols-[1.2fr_0.8fr] md:items-center md:p-10">
                <div>
                    <p class="text-[11px] uppercase tracking-[0.16em] text-primary">New Full Experience</p>
                    <h2 class="mt-2 text-3xl font-semibold leading-tight text-secondary md:text-4xl">
                        Scent Match is now a guided journey.
                    </h2>
                    <p class="mt-3 max-w-2xl text-sm leading-relaxed text-secondary-light md:text-base">
                        Answer personalized questions step-by-step, get your signature profile, and save every result in your scent history.
                    </p>
                    <a href="{{ route('scent-match.create') }}" class="mt-6 inline-flex items-center rounded-xl bg-amber-700 px-6 py-3 text-xs uppercase tracking-[0.15em] text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-amber-800">
                        Start Scent Match
                    </a>
                </div>
                <div class="rounded-2xl border border-white/80 bg-white/80 p-5">
                    <p class="text-[11px] uppercase tracking-[0.15em] text-primary">What you'll unlock</p>
                    <ul class="mt-3 space-y-2 text-sm text-stone-700">
                        <li>- Personalized profile logic</li>
                        <li>- Product recommendations</li>
                        <li>- Saved result record</li>
                        <li>- Smooth animated experience</li>
                    </ul>
                </div>
            </div>
        </section>

        <section data-animate
            class="mx-4 mt-12 flex flex-col items-start justify-between gap-8 rounded-3xl bg-rose-100/80 px-5 py-10 sm:px-6 md:mx-8 md:gap-12 md:px-12 md:py-14 lg:flex-row lg:items-center lg:px-16"
            id="story">
            <div class="w-full lg:max-w-3xl">
                <h2 class="text-3xl font-light leading-tight text-secondary sm:text-4xl lg:text-6xl xl:text-7xl">
                    Science of Happy.
                </h2>
                <p class="mt-4 text-base leading-relaxed text-secondary-light sm:text-lg md:text-xl">
                    Citrus and floral notes aren't just smells—they are bio-hacks for your brain. Explore how our olfactory blends boost mood and focus through botanical precision.
                </p>
            </div>

            <div class="grid w-full max-w-xl grid-cols-2 gap-3 sm:gap-4 md:gap-6">
                <img src="/images/scent-lab/science-1.jpg" alt="Scent details"
                    class="h-44 w-full rounded-xl border border-white/50 object-cover shadow-sm sm:h-52 md:h-64 xl:h-80">
                <img src="/images/scent-lab/science-2.jpg" alt="Scent experience"
                    class="mt-6 h-44 w-full rounded-xl border border-white/50 object-cover shadow-sm sm:mt-10 sm:h-52 md:mt-12 md:h-64 xl:h-80">
            </div>
        </section>
    </main>
@endsection