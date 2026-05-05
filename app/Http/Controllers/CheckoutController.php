<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CheckoutController extends Controller
{
    public function create(): View
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('status', 'Your cart is empty. Add some items before checkout.');
        }

        $products = Product::with('category')->whereIn('id', array_keys($cart))->get();

        $items = $products->map(function (Product $product) use ($cart) {
            $quantity = max(1, (int) ($cart[$product->id] ?? 1));

            return [
                'product' => $product,
                'qty' => $quantity,
                'line_total' => $quantity * (float) $product->price,
            ];
        });

        $subtotal = $items->sum('line_total');
        $tax = $subtotal * 0.08;
        $total = $subtotal + $tax;

        return view('storefront.checkout', compact('items', 'subtotal', 'tax', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('status', 'Your cart is empty. Add items before checkout.');
        }

        $data = $request->validate([
            'customer_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address_line1' => ['nullable', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:40'],
            'country' => ['nullable', 'string', 'max:255'],
            'payment_method' => ['nullable', 'string', 'in:cod,stripe,bank_transfer'],
        ]);

        $checkoutEmail = $data['email'] ?? session('order_email');
        $data['email'] = $checkoutEmail ?: '';
        $data['customer_name'] = $data['customer_name'] ?? '';
        $data['phone'] = $data['phone'] ?? '';
        $data['address_line1'] = $data['address_line1'] ?? '';
        $data['city'] = $data['city'] ?? '';
        $data['state'] = $data['state'] ?? '';
        $data['postal_code'] = $data['postal_code'] ?? '';
        $data['country'] = $data['country'] ?? '';
        $data['payment_method'] = $data['payment_method'] ?? 'cod';

        if ($checkoutEmail && ! session('order_email')) {
            session(['order_email' => $checkoutEmail]);
        }

        $user = null;
        if (! empty($checkoutEmail)) {
            $user = User::where('email', $checkoutEmail)->first();
            if (! $user) {
                $user = User::create([
                    'name' => $data['customer_name'] ?: explode('@', $checkoutEmail)[0],
                    'email' => $checkoutEmail,
                    'password' => Hash::make(uniqid()),
                    'is_admin' => false,
                ]);
            }
        }


        $products = Product::whereIn('id', array_keys($cart))->get();

        $items = $products->map(function (Product $product) use ($cart) {
            $qty = max(1, (int) ($cart[$product->id] ?? 1));

            return [
                'product' => $product,
                'qty' => $qty,
                'line_total' => $qty * (float) $product->price,
            ];
        });

        $subtotal = $items->sum('line_total');
        $tax = $subtotal * 0.08;
        $total = $subtotal + $tax;

        // Find or create user based on email
        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            $user = User::create([
                'name' => $data['customer_name'],
                'email' => $data['email'],
                'password' => Hash::make(uniqid()), // Random password
                'is_admin' => false,
            ]);
        }

        $order = Order::create([
            'user_id' => $user?->id,
            'customer_name' => $data['customer_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address_line1' => $data['address_line1'],
            'address_line2' => $data['address_line2'] ?? null,
            'city' => $data['city'],
            'state' => $data['state'],
            'postal_code' => $data['postal_code'],
            'country' => $data['country'],
            'payment_method' => $data['payment_method'],
            'payment_status' => 'pending',
            'status' => 'pending',
            'total_amount' => $total,
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'product_name' => $item['product']->name,
                'quantity' => $item['qty'],
                'unit_price' => $item['product']->price,
                'line_total' => $item['line_total'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.index')->with('status', 'Thank you! Your order has been placed successfully. Cash on delivery is selected for now.');
    }
}
