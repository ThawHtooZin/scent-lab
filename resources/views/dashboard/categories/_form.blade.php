@csrf
@php($c = $category ?? null)

<div class="grid gap-5 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', optional($c)->name)" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="slug" :value="__('Slug (optional)')" />
        <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', optional($c)->slug)" />
        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="display_order" :value="__('Display order')" />
        <x-text-input id="display_order" name="display_order" type="number" min="0" class="mt-1 block w-full" :value="old('display_order', optional($c)->display_order ?? 0)" required />
        <x-input-error :messages="$errors->get('display_order')" class="mt-2" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="description" :value="__('Description')" />
        <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('description', optional($c)->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
</div>

<div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
    <a href="{{ route('dashboard.categories.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">{{ __('Cancel') }}</a>
    <button type="submit" class="inline-flex items-center rounded-md bg-amber-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-amber-800">{{ $c ? __('Save changes') : __('Create category') }}</button>
</div>
