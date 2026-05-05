@extends('layouts.storefront')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-semibold">Your Orders</h1>
            <p class="mt-2 text-sm text-gray-600">View the status of your past purchases.</p>
        </div>
    </div>

    @if($showForm ?? false)
        <div class="mt-8 max-w-md mx-auto">
            <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
                <h2 class="text-lg font-medium mb-4">Find Your Orders</h2>
                <form method="GET" action="{{ route('orders.index') }}">
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" id="email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent">
                    </div>
                    <button type="submit"
                            class="w-full bg-amber-700 text-white py-2 px-4 rounded-md hover:bg-amber-800 transition-colors">
                        View Orders
                    </button>
                </form>
            </div>
        </div>
    @else
        <div class="mt-4 mb-6">
            <p class="text-sm text-gray-600">Showing orders for: <strong>{{ $email }}</strong></p>
            <a href="{{ route('orders.index') }}" class="text-sm text-amber-700 hover:text-amber-800">Search different email</a>
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
                                <a href="{{ route('orders.show', $order) }}?email={{ urlencode($email) }}" class="text-amber-700 hover:text-amber-800">Details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">No orders found for this email address.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
