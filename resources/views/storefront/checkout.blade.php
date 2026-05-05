@extends('layouts.storefront')

@section('content')
<main class="px-5 py-8 md:px-12 md:pb-16">
    <h1 class="mb-4 text-4xl font-medium md:text-5xl">Checkout</h1>
    <section class="grid gap-10 lg:grid-cols-[2fr_1fr]">
        <div class="space-y-5 rounded-lg border border-stone-200 bg-white p-6">
            <h2 class="text-xl font-semibold">Shipping & contact</h2>
            <form method="POST" action="{{ route('checkout.store') }}" class="grid gap-4">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="block">
                        <span class="text-sm font-medium text-stone-700">Full name</span>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                            class="mt-1 block w-full rounded border border-stone-200 bg-stone-50 px-3 py-2 text-sm">
                        <x-input-error :messages="$errors->get('customer_name')" class="mt-1" />
                    </label>
                    <label class="block">
                        <span class="text-sm font-medium text-stone-700">Email</span>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="mt-1 block w-full rounded border border-stone-200 bg-stone-50 px-3 py-2 text-sm">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </label>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="block">
                        <span class="text-sm font-medium text-stone-700">Phone</span>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                            class="mt-1 block w-full rounded border border-stone-200 bg-stone-50 px-3 py-2 text-sm">
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </label>
                    <label class="block">
                        <span class="text-sm font-medium text-stone-700">Country</span>
                        <input type="text" name="country" value="{{ old('country') }}" required
                            class="mt-1 block w-full rounded border border-stone-200 bg-stone-50 px-3 py-2 text-sm">
                        <x-input-error :messages="$errors->get('country')" class="mt-1" />
                    </label>
                </div>

                <label class="block">
                    <span class="text-sm font-medium text-stone-700">Address line 1</span>
                    <input type="text" name="address_line1" value="{{ old('address_line1') }}" required
                        class="mt-1 block w-full rounded border border-stone-200 bg-stone-50 px-3 py-2 text-sm">
                    <x-input-error :messages="$errors->get('address_line1')" class="mt-1" />
                </label>

                <label class="block">
                    <span class="text-sm font-medium text-stone-700">Address line 2 <span class="text-stone-400">(optional)</span></span>
                    <input type="text" name="address_line2" value="{{ old('address_line2') }}"
                        class="mt-1 block w-full rounded border border-stone-200 bg-stone-50 px-3 py-2 text-sm">
                </label>

                <div class="grid gap-4 sm:grid-cols-3">
                    <label class="block">
                        <span class="text-sm font-medium text-stone-700">City</span>
                        <input type="text" name="city" value="{{ old('city') }}" required
                            class="mt-1 block w-full rounded border border-stone-200 bg-stone-50 px-3 py-2 text-sm">
                        <x-input-error :messages="$errors->get('city')" class="mt-1" />
                    </label>
                    <label class="block">
                        <span class="text-sm font-medium text-stone-700">State</span>
                        <input type="text" name="state" value="{{ old('state') }}" required
                            class="mt-1 block w-full rounded border border-stone-200 bg-stone-50 px-3 py-2 text-sm">
                        <x-input-error :messages="$errors->get('state')" class="mt-1" />
                    </label>
                    <label class="block">
                        <span class="text-sm font-medium text-stone-700">Postal code</span>
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" required
                            class="mt-1 block w-full rounded border border-stone-200 bg-stone-50 px-3 py-2 text-sm">
                        <x-input-error :messages="$errors->get('postal_code')" class="mt-1" />
                    </label>
                </div>

                <div class="space-y-3 pt-4">
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-stone-500">Payment method</p>
                    <label class="flex items-center gap-3 rounded border border-stone-200 bg-stone-50 p-4">
                        <input type="radio" name="payment_method" value="cod" checked>
                        <span>
                            <strong>Cash on delivery</strong>
                            <p class="text-sm text-stone-600">Pay when your order arrives.</p>
                        </span>
                    </label>
                    <label class="flex items-center gap-3 rounded border border-stone-200 bg-stone-50 p-4 opacity-50">
                        <input type="radio" name="payment_method" value="stripe" disabled>
                        <span>
                            <strong>Stripe</strong>
                            <p class="text-sm text-stone-600">Coming soon.</p>
                        </span>
                    </label>
                    <label class="flex items-center gap-3 rounded border border-stone-200 bg-stone-50 p-4 opacity-50">
                        <input type="radio" name="payment_method" value="bank_transfer" disabled>
                        <span>
                            <strong>Bank transfer</strong>
                            <p class="text-sm text-stone-600">Coming soon.</p>
                        </span>
                    </label>
                </div>

                <button type="submit"
                    class="mt-4 inline-flex w-full items-center justify-center rounded bg-amber-700 px-5 py-3 text-sm uppercase tracking-[0.2em] text-white hover:bg-amber-800">
                    Place order
                </button>
            </form>
        </div>

        <aside class="space-y-5 rounded-lg border border-stone-200 bg-white p-6">
            <h2 class="text-xl font-semibold">Order summary</h2>
            <div class="space-y-3">
                @foreach ($items as $item)
                    <div class="flex items-center justify-between gap-3 border-b border-stone-200 pb-3">
                        <div>
                            <p class="font-medium">{{ $item['product']->name }}</p>
                            <p class="text-sm text-stone-500">{{ $item['qty'] }} × ${{ number_format($item['product']->price, 2) }}</p>
                        </div>
                        <p class="font-medium">${{ number_format($item['line_total'], 2) }}</p>
                    </div>
                @endforeach
            </div>
            <div class="space-y-2 border-t border-stone-200 pt-4 text-sm text-stone-600">
                <div class="flex justify-between"><span>Subtotal</span><span>${{ number_format($subtotal, 2) }}</span></div>
                <div class="flex justify-between"><span>Tax</span><span>${{ number_format($tax, 2) }}</span></div>
            </div>
            <div class="flex justify-between border-t border-stone-200 pt-4 text-lg font-semibold">
                <span>Total</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>
            <p class="mt-4 text-sm text-stone-500">Only cash on delivery is available for checkout right now. Other payment options are displayed for future support.</p>
        </aside>
    </section>
</main>
@endsection
