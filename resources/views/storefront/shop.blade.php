@extends('layouts.storefront')

@section('content')
<main class="px-5 py-8 md:px-12">
    <h1 class="text-center text-3xl font-medium md:text-4xl">Shop collection drops</h1>

    <section class="grid gap-5 pb-10 md:grid-cols-4">
        @foreach ($products as $product)
            <article class="p-3 border border-stone-200 rounded-lg">
                @if ($product->image)
                    <img src="/images/products/{{ $product->image }}" alt="Hero bottle" class="aspect-[4/5] w-full object-cover rounded-md">
                @else
                    <div class="aspect-[4/5] w-full rounded-md border border-stone-200 bg-stone-100"></div>
                @endif
                <p class="mt-2 text-[10px] uppercase tracking-[0.12em] text-stone-500">{{ optional($product->category)->collection_name ?? optional($product->category)->name ?? 'Uncategorized' }}</p>
                <h3 class="mt-1 text-lg font-medium md:text-xl">{{ $product->name }}</h3>
                <p class="text-sm text-stone-600">{{ $product->description }}</p>
                <div class="mt-2 grid gap-2 sm:grid-cols-[auto_1fr] items-center">
                    <div>
                        <p class="text-sm text-stone-600">Stock: {{ $product->stock }}</p>
                        <strong class="text-sm">${{ number_format($product->price, 2) }}</strong>
                    </div>
                    <a href="{{ route('product.show', $product) }}" class="text-[10px] uppercase tracking-[0.08em] text-stone-700 underline">Explore Product</a>
                </div>
            </article>
        @endforeach
    </section>
</main>
@endsection
