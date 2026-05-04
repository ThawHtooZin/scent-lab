<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Catalog') }}
                </h2>
                <p class="text-sm text-gray-500">Manage fragrances, pricing, and imagery keys.</p>
            </div>
            <a href="{{ route('dashboard.products.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-amber-700 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-amber-800">
                <svg class="me-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                {{ __('Add product') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8 sm:py-10">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <div class="group overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm ring-1 ring-gray-900/5 transition hover:shadow-md">
                        <div class="relative aspect-[4/5] overflow-hidden bg-stone-100">
                            <img src="{{ '/images/products/' . $product->image }}" alt="Hero bottle"
                                class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.02]">
                            @if ($product->is_featured)
                                <span class="absolute left-3 top-3 rounded-full bg-amber-700/95 px-2.5 py-0.5 text-[10px] font-semibold uppercase tracking-wider text-white shadow">
                                    Featured
                                </span>
                            @endif
                        </div>
                        <div class="p-5">
                            <p class="text-[10px] font-semibold uppercase tracking-[0.15em] text-gray-400">{{ $product->subtitle }}</p>
                            <h3 class="mt-1 text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
                            <p class="mt-2 text-2xl font-light text-amber-800">${{ number_format($product->price, 2) }}</p>
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('dashboard.products.edit', $product) }}"
                                    class="inline-flex flex-1 items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                                    {{ __('Edit') }}
                                </a>
                                <form method="POST" action="{{ route('dashboard.products.destroy', $product) }}" class="inline"
                                    onsubmit="return confirm(@json(__('Delete this product?')));">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center rounded-lg border border-red-100 bg-red-50 px-3 py-2 text-sm font-medium text-red-700 hover:bg-red-100">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($products->isEmpty())
                <div class="rounded-2xl border border-dashed border-gray-200 bg-white/80 p-12 text-center">
                    <p class="text-gray-500">{{ __('No products yet. Create your first bottle.') }}</p>
                    <a href="{{ route('dashboard.products.create') }}" class="mt-4 inline-block text-sm font-medium text-amber-700 underline">
                        {{ __('Add product') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
