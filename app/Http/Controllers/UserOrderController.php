<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserOrderController extends Controller
{
    public function index(Request $request): View
    {
        // Check if user is authenticated or has a session email
        $user = auth()->user();
        $sessionEmail = session('order_email');

        if (!$user && !$sessionEmail) {
            return view('storefront.orders.index', [
                'orders' => collect(),
                'showModal' => true
            ]);
        }

        // If we have a session email but no authenticated user, try to find/create user
        if (!$user && $sessionEmail) {
            $user = User::where('email', $sessionEmail)->first();
            if ($user) {
                Auth::login($user);
            }
        }

        if (!$user) {
            return view('storefront.orders.index', [
                'orders' => collect(),
                'showModal' => true
            ]);
        }

        $orders = $user->orders()->withCount('items')->orderByDesc('created_at')->get();

        return view('storefront.orders.index', compact('orders'));
    }

    public function storeEmail(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $email = $data['email'];

        // Check if user already exists
        $user = User::where('email', $email)->first();

        if (!$user) {
            // Create new user with email only
            $user = User::create([
                'name' => explode('@', $email)[0], // Use part before @ as name
                'email' => $email,
                'password' => Hash::make(uniqid()), // Random password since they won't log in normally
                'is_admin' => false,
            ]);
        }

        // Store email in session and log them in
        session(['order_email' => $email]);
        Auth::login($user);

        return redirect()->route('orders.index');
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
