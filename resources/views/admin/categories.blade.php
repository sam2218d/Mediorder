
@extends('layouts.adminnav')

@section('content')
<main class="flex-1 p-4 sm:p-6 lg:p-8">
    
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manage Categories</h1>
            <p class="text-sm text-gray-500 mt-1">Add, edit, or remove product categories.</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ url('/admin/categories/create') }}" class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 transition-colors">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add Category
            </a>
        </div>
    </div>
    
            @if(session('success'))
                <div class="alert alert-success m-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger m-3">
                    {{ session('error') }}
                </div>
            @endif


    <div class="bg-white border border-gray-100 rounded-xl shadow-sm overflow-hidden">
        
        <div class="p-4 border-b border-gray-100 flex flex-col sm:flex-row gap-4 justify-between items-center bg-white">
            <div class="relative w-full sm:max-w-md text-gray-400 focus-within:text-gray-600">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" /></svg>
                </div>
                <input type="text" placeholder="Search categories..." class="block w-full rounded-lg border border-gray-200 py-2 pl-10 pr-3 text-gray-900 bg-gray-50 hover:bg-white focus:bg-white focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6 transition-colors outline-none">
            </div>
            <div class="text-sm font-medium text-gray-500 w-full sm:w-auto text-left sm:text-right">
                Showing 8 categories
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-16">image</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category Name</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category ID</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Products</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">descrip</th>
                    </tr>
                </thead>
 <tbody class="divide-y divide-gray-100 bg-white">

@if ($categories->isNotEmpty())

    @foreach ($categories as $category)

    <tr class="hover:bg-gray-50 transition-colors">

        <!-- Image -->
        <td class="px-6 py-4 whitespace-nowrap">
            @if($category->image)
                <img
                    src="{{ asset('storage/' . $category->image) }}"
                    alt="{{ $category->name }}"
                    class="h-12 w-12 rounded-lg object-cover border"
                >
            @else
                <div class="h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center">
                    <span class="text-xs text-gray-400">N/A</span>
                </div>
            @endif
        </td>

        <!-- Name -->
        <td class="px-6 py-4">
            <div class="font-semibold text-gray-900">
                {{ $category->name }}
            </div>
        </td>

        <!-- ID -->
        <td class="px-6 py-4 text-sm text-gray-500">
            {{ $category->id }}
        </td>

        <!-- Slug -->
        <td class="px-6 py-4 text-sm text-gray-500">
            {{ $category->slug }}
        </td>

        <!-- Description -->
        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">
            {{ $category->description }}
        </td>

        <!-- Actions -->
        <td class="px-6 py-4 text-right">
            <div class="flex justify-end gap-3">

                <a href="{{ route('admin.categories.edit', $category->id) }}"
                   class="text-blue-600 hover:text-blue-800">
                    Edit
                </a>

                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                      method="POST"
                      onsubmit="return confirm('Delete this category?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="text-red-600 hover:text-red-800">
                        Delete
                    </button>

                </form>

            </div>
        </td>

    </tr>

    @endforeach

@else

    <tr>
        <td colspan="6" class="text-center py-8 text-gray-500">
            No categories found.
        </td>
    </tr>

@endif

</tbody>
            </table>
        </div>
    </div>
</main>
@endsection