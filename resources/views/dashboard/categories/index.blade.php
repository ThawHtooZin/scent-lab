@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-3xl font-semibold">Categories</h1>
            <p class="mt-2 text-sm text-gray-600">Organize products by collection and storefront category.</p>
        </div>
        <a href="{{ route('dashboard.categories.create') }}" class="inline-flex items-center rounded-lg bg-amber-700 px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-amber-800">Add category</a>
    </div>

    @if (session('status'))
        <div class="mt-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('status') }}</div>
    @endif

    <div class="mt-8 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Category</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Slug</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">Display order</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($categories as $category)
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-700">{{ $category->name }}</td>
                        <td class="px-4 py-4 text-sm text-gray-700">{{ $category->slug }}</td>
                        <td class="px-4 py-4 text-sm text-gray-700">{{ $category->display_order }}</td>
                        <td class="px-4 py-4 text-right text-sm font-medium gap-2 flex justify-end">
                            <a href="{{ route('dashboard.categories.edit', $category) }}" class="text-amber-700 hover:text-amber-800">Edit</a>
                            <form method="POST" action="{{ route('dashboard.categories.destroy', $category) }}" onsubmit="return confirm('@json(__('Delete this category?'))');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-700 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">No categories configured yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
