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

{{-- Email Collection Modal --}}
@if($showModal ?? false)
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="email-modal">
    <div class="bg-white p-8 rounded-lg max-w-md w-full mx-4">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-900 mb-2">Welcome to The Scent Lab</h2>
            <p class="text-gray-600">Enter your email to view your orders and track your purchases.</p>
        </div>

        <form method="POST" action="{{ route('orders.store') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                       placeholder="your@email.com">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeModal()"
                        class="flex-1 bg-gray-200 text-gray-800 py-2 px-4 rounded-md hover:bg-gray-300 transition-colors">
                    Cancel
                </button>
                <button type="submit"
                        class="flex-1 bg-amber-700 text-white py-2 px-4 rounded-md hover:bg-amber-800 transition-colors">
                    Continue
                </button>
            </div>
        </form>

        <p class="text-xs text-gray-500 mt-4 text-center">
            We'll create a simple account for you to track your orders. No password required!
        </p>
    </div>
</div>

<script>
function closeModal() {
    document.getElementById('email-modal').style.display = 'none';
    window.history.back();
}
</script>
@endif
@endsection
