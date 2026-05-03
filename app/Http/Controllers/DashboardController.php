<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $productCount = $request->user()->is_admin
            ? Product::query()->count()
            : null;

        return view('dashboard', [
            'productCount' => $productCount,
        ]);
    }
}
