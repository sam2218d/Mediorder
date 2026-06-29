```php
@extends('layouts.adminnav')

@section('content')
<main class="flex-1 p-4 sm:p-6 lg:p-8">

    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Category</h1>
            <p class="text-sm text-gray-500 mt-1">
                Update the details of this product category.
            </p>
        </div>

        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.categories.index') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50">

                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>

                Back to Categories
            </a>
        </div>
    </div>

    <form action="{{ route('admin.categories.update', $category->id) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">

                    <h2 class="text-base font-semibold text-gray-900 mb-6">
                        Category Information
                    </h2>

                    <div class="space-y-5">

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-2">
                                Category Name *
                            </label>

                            <input type="text"
                                name="name"
                                id="name"
                                value="{{ old('name') }}"
                                placeholder="e.g. Eye Care"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                            @error('name')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-2">
                                Slug
                            </label>

                            <input type="text"
                                name="slug"
                                id="slug"
                                value="{{ old('slug') }}"
                                placeholder="eye-care"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">

                            <p class="text-xs text-gray-500 mt-1">
                                Leave blank to auto-generate from category name.
                            </p>

                            @error('slug')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-2">
                                Description
                            </label>

                            <textarea
                                name="description"
                                rows="5"
                                placeholder="Enter category description..."
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('description') }}</textarea>

                            @error('description')
                                <p class="text-red-500 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                </div>
            </div>

            <!-- Right Section -->
            <div>

                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">

                    <h2 class="text-base font-semibold text-gray-900 mb-6">
                        Category Image
                    </h2>

                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center">

                        <svg class="mx-auto h-12 w-12 text-gray-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M3 16.5V18a2.25 2.25 0 002.25 2.25h13.5A2.25 2.25 0 0021 18v-1.5M16.5 7.5L12 3m0 0L7.5 7.5M12 3v13.5" />
                        </svg>

                        <div class="mt-4">
                            <label for="image"
                                class="cursor-pointer text-emerald-600 font-semibold hover:text-emerald-500">

                                Upload Image
                            </label>

                            <input type="file"
                                name="image"
                                id="image"
                                class="hidden">
                        </div>

                        <p class="text-xs text-gray-500 mt-2">
                            PNG, JPG, JPEG, SVG (Max 2MB)
                        </p>

                        @error('image')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

        <div class="mt-8 border-t pt-6 flex justify-end gap-4">

            <a href="{{ route('admin.categories.index') }}"
                class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                Cancel
            </a>

            <button type="submit"
                class="px-6 py-2.5 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-500">
                Save Category
            </button>

        </div>

    </form>

</main>

<script>
document.getElementById('name').addEventListener('input', function () {
    let slug = this.value
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)/g, '');

    document.getElementById('slug').value = slug;
});
</script>

@endsection
```
