<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::orderBy('display_order')->get();

        return view('dashboard.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'description' => ['nullable', 'string'],
            'display_order' => ['required', 'integer', 'min:0'],
        ]);

        $data['slug'] = 
            str($data['slug'] ?: $data['name'])->slug();

        Category::create($data);

        return redirect()->route('dashboard.categories.index')->with('status', 'Category created.');
    }

    public function edit(Category $category): View
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug,'.$category->id],
            'description' => ['nullable', 'string'],
            'display_order' => ['required', 'integer', 'min:0'],
        ]);

        $data['slug'] = 
            str($data['slug'] ?: $data['name'])->slug();

        $category->update($data);

        return redirect()->route('dashboard.categories.index')->with('status', 'Category updated.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('dashboard.categories.index')->with('status', 'Category deleted.');
    }
}
