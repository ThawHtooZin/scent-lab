@csrf
@php($p = $product ?? null)

<div class="grid gap-5 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', optional($p)->name)" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="slug" :value="__('Slug (optional)')" />
        <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', optional($p)->slug)" />
        <x-input-error :messages="$errors->get('slug')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="subtitle" :value="__('Subtitle')" />
        <x-text-input id="subtitle" name="subtitle" type="text" class="mt-1 block w-full" :value="old('subtitle', optional($p)->subtitle)" />
        <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
    </div>
    <div class="sm:col-span-2">
        <x-input-label for="description" :value="__('Description')" />
        <textarea id="description" name="description" rows="4" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('description', optional($p)->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="price" :value="__('Price')" />
        <x-text-input id="price" name="price" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('price', optional($p)->price)" required />
        <x-input-error :messages="$errors->get('price')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="size" :value="__('Size')" />
        <x-text-input id="size" name="size" type="text" class="mt-1 block w-full" :value="old('size', optional($p)->size ?? '100ML')" required />
        <x-input-error :messages="$errors->get('size')" class="mt-2" />
    </div>
    <div class="sm:col-span-2">
        <x-input-label for="image" :value="__('Image Upload')" />
        <x-text-input id="image" name="image" type="file" class="mt-1 block w-full font-mono text-sm" :value="old('image', optional($p)->image)" />
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="top_note" :value="__('Top note')" />
        <x-text-input id="top_note" name="top_note" type="text" class="mt-1 block w-full" :value="old('top_note', optional($p)->top_note)" />
    </div>
    <div>
        <x-input-label for="heart_note" :value="__('Heart note')" />
        <x-text-input id="heart_note" name="heart_note" type="text" class="mt-1 block w-full" :value="old('heart_note', optional($p)->heart_note)" />
    </div>
    <div class="sm:col-span-2">
        <x-input-label for="base_note" :value="__('Base note')" />
        <x-text-input id="base_note" name="base_note" type="text" class="mt-1 block w-full" :value="old('base_note', optional($p)->base_note)" />
    </div>
    <div>
        <x-input-label for="display_order" :value="__('Display order')" />
        <x-text-input id="display_order" name="display_order" type="number" min="0" class="mt-1 block w-full" :value="old('display_order', optional($p)->display_order ?? 0)" required />
        <x-input-error :messages="$errors->get('display_order')" class="mt-2" />
    </div>
    <div class="flex items-center pt-6">
        <input id="is_featured" type="checkbox" name="is_featured" value="1" @checked(old('is_featured', optional($p)->is_featured ?? false))
            class="rounded border-gray-300 text-amber-600 shadow-sm focus:ring-amber-500" />
        <x-input-label for="is_featured" class="ms-2" :value="__('Featured on homepage')" />
    </div>
</div>

<div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
    <a href="{{ route('dashboard.products.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">{{ __('Cancel') }}</a>
    <button type="submit"
        class="inline-flex items-center rounded-md bg-amber-700 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-amber-800 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
        {{ $p ? __('Save changes') : __('Create product') }}
    </button>
</div>
