<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('New product') }}
            </h2>
            <p class="text-sm text-gray-500">{{ __('Fill in details — image comes from your scent-lab config key.') }}</p>
        </div>
    </x-slot>

    <div class="py-8 sm:py-10">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm sm:rounded-2xl">
                <form method="POST" action="{{ route('dashboard.products.store') }}" class="space-y-5 p-6 sm:p-8">
                    @include('dashboard.products._form', ['product' => null])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
