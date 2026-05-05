@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-2">
        <h1 class="text-3xl font-semibold">Add new category</h1>
        <p class="text-sm text-gray-600">Create a storefront collection to group products.</p>
    </div>

    <div class="mt-8 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <form method="POST" action="{{ route('dashboard.categories.store') }}" class="space-y-5 p-6 sm:p-8">
            @include('dashboard.categories._form')
        </form>
    </div>
</div>
@endsection
