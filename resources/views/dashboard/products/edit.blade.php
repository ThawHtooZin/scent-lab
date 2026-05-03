<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit') }} — {{ $product->name }}
            </h2>
            <p class="text-sm text-gray-500">{{ __('Slug:') }} <code class="rounded bg-gray-100 px-1.5 py-0.5 text-xs">{{ $product->slug }}</code></p>
        </div>
    </x-slot>

    <div class="py-8 sm:py-10">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
                <form method="POST" action="{{ route('dashboard.products.update', $product) }}" class="space-y-5 p-6 sm:p-8">
                    @method('PUT')
                    @include('dashboard.products._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
