@extends('layouts.storefront')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-semibold">Your Orders</h1>
            <p class="mt-2 text-sm text-gray-600">View the status of your past purchases.</p>
        </div>
    </div>

    <div class="mt-8 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Order</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Placed</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Total</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($orders as $order)
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-700">#{{ $order->id }}</td>
                        <td class="px-4 py-4 text-sm text-gray-700">{{ $order->created_at->format('M j, Y') }}</td>
                        <td class="px-4 py-4 text-sm text-gray-700 capitalize">{{ $order->status }}</td>
                        <td class="px-4 py-4 text-sm text-gray-700">${{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-4 py-4 text-right text-sm font-medium">
                            <a href="{{ route('orders.show', $order) }}" class="text-amber-700 hover:text-amber-800">Details</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">You have not placed any orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
