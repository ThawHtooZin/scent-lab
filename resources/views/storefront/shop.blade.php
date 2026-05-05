@extends('layouts.storefront')

@section('content')
<main class="px-5 py-8 md:px-12">
    <h1 class="text-center text-3xl font-medium md:text-4xl mb-12">Shop Collection Drops</h1>

    @foreach ($categories as $category)
        <section class="mb-16">
            <h2 class="text-2xl font-medium mb-8 text-center md:text-left">{{ $category->name }}</h2>

            <div class="grid gap-5 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($category->products as $product)
                    <article class="p-3 border border-stone-200 rounded-lg flex flex-col justify-between">
                        <div>
                            @if ($product->image)
                                <img src="/images/products/{{ $product->image }}" alt="{{ $product->name }}"
                                    class="aspect-[4/5] w-full object-cover rounded-md">
                            @else
                                <div class="aspect-[4/5] w-full rounded-md border border-stone-200 bg-stone-100"></div>
                            @endif
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
            </div>
        </section>
    @endforeach
</main>
@endsection
