<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::withCount('items')->orderByDesc('created_at')->get();

        return view('dashboard.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load('items.product');

        return view('dashboard.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,processing,shipped,delivered,cancelled'],
        ]);

        $order->update(['status' => $data['status']]);

        return redirect()->route('dashboard.orders.show', $order)
            ->with('success', 'Order status updated successfully.');
    }
}
