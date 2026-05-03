<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 sm:py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (auth()->user()->is_admin && $productCount !== null)
                {{-- Admin hub --}}
                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-amber-900 via-amber-800 to-stone-900 p-8 text-white shadow-xl sm:p-10">
                    <div class="pointer-events-none absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>
                    <div class="pointer-events-none absolute -bottom-16 left-10 h-48 w-48 rounded-full bg-amber-500/20 blur-2xl"></div>
                    <div class="relative max-w-2xl">
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-200/90">{{ __('The Scent Lab') }}</p>
                        <h1 class="mt-2 font-serif text-3xl font-medium sm:text-4xl">{{ __('Atelier control room') }}</h1>
                        <p class="mt-3 text-sm leading-relaxed text-amber-100/90">
                            {{ __('Manage your catalog, imagery keys, and featured picks for the storefront.') }}
                        </p>
                        <div class="mt-8 flex flex-wrap gap-4">
                            <a href="{{ route('dashboard.products.index') }}"
                                class="inline-flex items-center rounded-xl bg-white px-5 py-3 text-sm font-semibold text-amber-900 shadow-md transition hover:bg-amber-50">
                                <svg class="me-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/></svg>
                                {{ __('Open catalog') }}
                                <span class="ms-2 rounded-full bg-amber-100 px-2 py-0.5 text-xs font-bold text-amber-900">{{ $productCount }}</span>
                            </a>
                            <a href="{{ route('home') }}"
                                class="inline-flex items-center rounded-xl border border-white/30 px-5 py-3 text-sm font-medium text-white backdrop-blur transition hover:bg-white/10">
                                {{ __('View storefront') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <a href="{{ route('dashboard.products.create') }}" class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm ring-1 ring-gray-900/5 transition hover:shadow-md">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100 text-amber-800">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        </div>
                        <h3 class="mt-4 font-semibold text-gray-900 group-hover:text-amber-800">{{ __('New product') }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ __('Add a fragrance with notes, price, and image key.') }}</p>
                    </a>
                    <a href="{{ route('dashboard.products.index') }}" class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm ring-1 ring-gray-900/5 transition hover:shadow-md">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-stone-100 text-stone-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        </div>
                        <h3 class="mt-4 font-semibold text-gray-900 group-hover:text-amber-800">{{ __('Edit inventory') }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ __('Quick access to every SKU and badge.') }}</p>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="group rounded-2xl border border-gray-100 bg-white p-6 shadow-sm ring-1 ring-gray-900/5 transition hover:shadow-md">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <h3 class="mt-4 font-semibold text-gray-900 group-hover:text-amber-800">{{ __('Account') }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ __('Profile, password, and session.') }}</p>
                    </a>
                </div>
            @else
                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-900/5">
                    <div class="p-8 text-center sm:p-12">
                        <p class="text-gray-600">{{ __("You're logged in!") }}</p>
                        <a href="{{ route('home') }}" class="mt-4 inline-block text-sm font-medium text-amber-700 underline">
                            {{ __('Back to the shop') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
