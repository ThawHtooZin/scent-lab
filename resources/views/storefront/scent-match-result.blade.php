@extends('layouts.storefront')

@section('content')
    <main class="mx-auto w-full max-w-6xl px-4 py-8 md:px-8 md:py-12">
        <section data-animate class="overflow-hidden rounded-3xl border border-stone-200 bg-white shadow-sm">
            <div class="grid gap-8 p-6 md:grid-cols-[1.1fr_0.9fr] md:p-10">
                <div>
                    <p class="text-[11px] uppercase tracking-[0.16em] text-primary">Your Scent Profile</p>
                    <h1 class="mt-2 text-4xl font-semibold leading-tight text-secondary md:text-5xl">{{ $match->profile_name }}</h1>
                    <p class="mt-3 text-lg text-secondary">{{ $match->headline }}</p>
                    <p class="mt-4 max-w-2xl text-sm leading-relaxed text-secondary-light md:text-base">{{ $match->reason }}</p>

                    <div class="mt-6 flex flex-wrap gap-2 text-xs uppercase tracking-[0.1em] text-stone-600">
                        <span class="rounded-full bg-stone-100 px-3 py-1">{{ str_replace('_', ' ', $match->daily_environment) }}</span>
                        <span class="rounded-full bg-stone-100 px-3 py-1">{{ str_replace('_', ' ', $match->energy_style) }}</span>
                        <span class="rounded-full bg-stone-100 px-3 py-1">{{ str_replace('_', ' ', $match->climate_profile) }}</span>
                        <span class="rounded-full bg-stone-100 px-3 py-1">{{ str_replace('_', ' ', $match->social_density) }}</span>
                    </div>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('scent-match.create') }}" class="rounded-xl border border-stone-300 px-4 py-2 text-xs uppercase tracking-[0.12em] text-stone-700 transition hover:border-stone-400">
                            Retake Match
                        </a>
                        <a href="{{ route('shop') }}" class="rounded-xl bg-amber-700 px-5 py-2 text-xs uppercase tracking-[0.12em] text-white transition hover:bg-amber-800">
                            Explore Shop
                        </a>
                    </div>
                </div>

                <div class="rounded-2xl border border-amber-100 bg-amber-50/60 p-5">
                    <p class="text-[11px] uppercase tracking-[0.16em] text-primary">Saved Record</p>
                    <p class="mt-2 text-sm text-stone-700">Your scent profile has been saved to our Scent Match database.</p>
                    <p class="mt-2 text-xs text-stone-500">Reference #{{ $match->id }} • {{ $match->created_at->format('M d, Y h:i A') }}</p>
                    @if ($match->email)
                        <p class="mt-2 text-xs text-stone-500">Email: {{ $match->email }}</p>
                    @endif
                </div>
            </div>
        </section>

        <section data-animate class="mt-8">
            <h2 class="text-2xl font-medium text-primary-dark">Recommended for you</h2>
            <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($products as $product)
                    <article data-animate class="rounded-2xl border border-stone-200 bg-white p-3 shadow-sm">
                        <img src="/images/products/{{ $product->image }}" alt="{{ $product->name }}" class="aspect-[4/5] w-full rounded-xl object-cover">
                        <h3 class="mt-3 text-xl font-medium text-secondary">{{ $product->name }}</h3>
                        <p class="mt-1 text-sm text-stone-600 line-clamp-2">{{ $product->description }}</p>
                        <div class="mt-3 flex items-center justify-between">
                            <p class="text-sm font-semibold text-primary-dark">{{ number_format((float) $product->price) }} MMK</p>
                            <a href="{{ route('product.show', $product) }}" class="text-[11px] uppercase tracking-[0.1em] underline">View</a>
                        </div>
                    </article>
                @empty
                    <div class="rounded-xl border border-dashed border-stone-300 bg-stone-50 p-4 text-sm text-stone-600 sm:col-span-2 lg:col-span-3">
                        Recommended products: {{ implode(', ', $match->recommended_products ?? []) }}
                    </div>
                @endforelse
            </div>
        </section>
    </main>
@endsection
