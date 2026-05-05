<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class UserOrderController extends Controller
{
    public function index(Request $request): View
    {
        $email = $request->get('email');

        if (!$email) {
            return view('storefront.orders.index', ['orders' => collect(), 'showForm' => true]);
        }

        $orders = Order::where('email', $email)
            ->withCount('items')
            ->orderByDesc('created_at')
            ->get();

        return view('storefront.orders.index', compact('orders', 'email'));
    }

    public function show(Request $request, Order $order): View
    {
        // Verify the order belongs to the provided email
        $email = $request->get('email');
        if ($email && $order->email !== $email) {
            abort(403, 'You can only view your own orders.');
        }

        $order->load('items.product');

        return view('storefront.orders.show', compact('order', 'email'));
    }
}
