@extends('layouts.adminnav')

@section('content')

<div class="container mx-auto px-6 py-6">

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Add New Medicine
            </h1>
            <p class="text-gray-500 mt-1">
                Create a new medicine in inventory.
            </p>
        </div>

        <a href="{{ route('admin.medicines.index') }}"
            class="px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200">
            ← Back
        </a>
    </div>

    <form action="{{ route('admin.medicines.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- LEFT SIDE -->
            <div class="lg:col-span-2">

                <div class="bg-white rounded-xl shadow border p-6">

                    <h2 class="text-lg font-semibold mb-6">
                        Medicine Information
                    </h2>

                    <!-- Name -->
                     <div>
                            <label class="block text-sm font-medium text-gray-900 mb-2">
                                Medicine Name *
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

                    <!-- Category -->
                    <div class="mb-5">
                        <label class="block mb-2 font-medium">
                            Category *
                        </label>

                        <select name="category_id"
                                class="w-full rounded-lg border-gray-300">

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <!-- Price & Stock -->
                    <div class="grid grid-cols-2 gap-4 mb-5">

                        <div>
                            <label class="block mb-2 font-medium">
                                Price *
                            </label>

                            <input type="number"
                                   step="0.01"
                                   name="price"
                                   value="{{ old('price') }}"
                                   class="w-full rounded-lg border-gray-300">
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Stock *
                            </label>

                            <input type="number"
                                   name="stock"
                                   value="{{ old('stock') }}"
                                   class="w-full rounded-lg border-gray-300">
                        </div>

                    </div>

                    <!-- Manufacturer -->
                    <div class="mb-5">
                        <label class="block mb-2 font-medium">
                            Manufacturer
                        </label>

                        <input type="text"
                               name="manufacturer"
                               value="{{ old('manufacturer') }}"
                               class="w-full rounded-lg border-gray-300"
                               placeholder="Sun Pharma">
                    </div>

                    <!-- Expiry Date -->
                    <div class="mb-5">
                        <label class="block mb-2 font-medium">
                            Expiry Date
                        </label>

                        <input type="date"
                               name="expiry_date"
                               value="{{ old('expiry_date') }}"
                               class="w-full rounded-lg border-gray-300">
                    </div>

                    <!-- Description -->
                    <div class="mb-5">
                        <label class="block mb-2 font-medium">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            class="w-full rounded-lg border-gray-300">{{ old('description') }}</textarea>
                    </div>

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div>

                <!-- Image -->
                <div class="bg-white rounded-xl shadow border p-6 mb-6">

                    <h2 class="text-lg font-semibold mb-4">
                        Medicine Image
                    </h2>

                    <input type="file"
                           name="image"
                           class="w-full border rounded-lg p-2">

                </div>

                <!-- Settings -->
                <div class="bg-white rounded-xl shadow border p-6">

                    <h2 class="text-lg font-semibold mb-4">
                        Settings
                    </h2>

                    <!-- Prescription -->
                    <div class="mb-5">
                        <label class="block mb-2 font-medium">
                            Requires Prescription *
                        </label>

                        <select name="requires_prescription"
                                class="w-full rounded-lg border-gray-300">

                            <option value="0">
                                No
                            </option>

                            <option value="1">
                                Yes
                            </option>

                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block mb-2 font-medium">
                            Status *
                        </label>

                        <select name="status"
                                class="w-full rounded-lg border-gray-300">

                            <option value="active">
                                Active
                            </option>

                            <option value="inactive">
                                Inactive
                            </option>

                        </select>
                    </div>

                </div>

            </div>

        </div>

        <div class="mt-8 flex justify-end gap-4">

            <a href="{{ route('admin.medicines.index') }}"
                class="px-5 py-2 border rounded-lg">
                Cancel
            </a>

            <button type="submit"
                    class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">

                Save Medicine

            </button>

        </div>

    </form>

</div>
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