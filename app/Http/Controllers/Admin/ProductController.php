<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()->orderBy('display_order')->orderBy('name')->get();

        return view('dashboard.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('dashboard.products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Product::create($this->validated($request));

        if ($request->hasFile('image')) {
            $data['image'] = $this->handleImageUpload($request->file('image'));
        }

        Product::create($data);

        return redirect()->route('dashboard.products.index')->with('status', 'Product created.');
    }

    public function edit(Product $product): View
    {
        return view('dashboard.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $product->update($this->validated($request, $product->id));

        if ($request->hasFile('image')) {
            $data['image'] = $this->handleImageUpload($request->file('image'));
        }

        $product->update($data);

        return redirect()->route('dashboard.products.index')->with('status', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return back()->with('status', 'Product deleted.');
    }

    private function handleImageUpload ($file): string 
    {
        $filename = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path('images/products'), $filename);

        return $filename;
    }

    private function validated(Request $request, ?int $productId = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug,'.$productId],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'size' => ['required', 'string', 'max:50'],
            'image' => ['required', 'image', 'max:255'],
            'top_note' => ['nullable', 'string', 'max:255'],
            'heart_note' => ['nullable', 'string', 'max:255'],
            'base_note' => ['nullable', 'string', 'max:255'],
            'display_order' => ['required', 'integer', 'min:0'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
        $data['is_featured'] = (bool) ($data['is_featured'] ?? false);

        return $data;
    }
}
