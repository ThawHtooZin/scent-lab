@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-3xl font-semibold">Order #{{ $order->id }}</h1>
            <p class="mt-1 text-sm text-gray-600">Placed {{ $order->created_at->format('M j, Y \a\t g:i A') }}</p>
        </div>
        <a href="{{ route('dashboard.orders.index') }}" class="text-sm font-medium text-amber-700 hover:text-amber-800">Back to orders</a>
    </div>

    @if (session('success'))
        <div class="mt-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-8 grid gap-6 lg:grid-cols-[1.4fr_0.9fr]">
        <div class="space-y-6 rounded-lg border border-gray-200 bg-white p-6">
            <section>
                <h2 class="text-lg font-semibold">Customer</h2>
                <p class="mt-2 text-sm text-gray-700">{{ $order->customer_name }}</p>
                <p class="text-sm text-gray-500">{{ $order->email }} · {{ $order->phone }}</p>
            </section>

            <section>
                <h2 class="text-lg font-semibold">Shipping address</h2>
                <div class="mt-2 text-sm text-gray-700">
                    <p>{{ $order->address_line1 }}</p>
                    @if ($order->address_line2)<p>{{ $order->address_line2 }}</p>@endif
                    <p>{{ $order->city }}, {{ $order->state }} {{ $order->postal_code }}</p>
                    <p>{{ $order->country }}</p>
                </div>
            </section>

            <section>
                <h2 class="text-lg font-semibold">Order items</h2>
                <div class="mt-4 divide-y divide-gray-200 border-t border-gray-200">
                    @foreach ($order->items as $item)
                        <div class="flex items-center justify-between py-4 text-sm text-gray-700">
                            <div>
                                <p class="font-medium">{{ $item->product_name }}</p>
                                <p class="text-xs text-gray-500">Qty {{ $item->quantity }}</p>
                            </div>
                            <p>${{ number_format($item->line_total, 2) }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        <aside class="rounded-lg border border-gray-200 bg-white p-6">
            <div class="space-y-4">
                <div>
                    <h2 class="text-lg font-semibold">Summary</h2>
                    <div class="mt-3 space-y-2 text-sm text-gray-700">
                        <div class="flex justify-between border-b border-gray-200 pb-2"><span>Payment</span><span class="uppercase">{{ $order->payment_method === 'cod' ? 'COD' : strtoupper(str_replace('_', ' ', $order->payment_method)) }}</span></div>
                        <div class="flex justify-between border-b border-gray-200 pb-2"><span>Payment status</span><span class="capitalize">{{ $order->payment_status }}</span></div>
                        <div class="flex justify-between border-b border-gray-200 pb-2"><span>Order status</span><span class="capitalize">{{ $order->status }}</span></div>
                        <div class="flex justify-between pt-3 text-base font-semibold"><span>Total</span><span>${{ number_format($order->total_amount, 2) }}</span></div>
                    </div>
                </div>

                <div class="rounded-lg bg-slate-50 p-4">
                    <h3 class="text-sm font-semibold text-slate-900">Update order status</h3>
                    <form action="{{ route('dashboard.orders.update', $order) }}" method="POST" class="mt-4 space-y-4">
                        @csrf
                        @method('PATCH')

                        <label class="block text-sm font-medium text-gray-700" for="status">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 sm:text-sm">
                            @foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                                <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="inline-flex items-center justify-center rounded-md bg-amber-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500">Save status</button>
                    </form>
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
