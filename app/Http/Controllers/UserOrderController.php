<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class UserOrderController extends Controller
{
    public function index(): View
    {
        $orders = auth()->user()->orders()->withCount('items')->orderByDesc('created_at')->get();

        return view('storefront.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $this->authorizeOrder($order);

        $order->load('items.product');

        return view('storefront.orders.show', compact('order'));
    }

    protected function authorizeOrder(Order $order): void
    {
        abort_unless(auth()->id() === $order->user_id, 403);
    }
}
