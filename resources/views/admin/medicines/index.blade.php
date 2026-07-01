@extends('layouts.adminnav')

@section('content')
<div class="container  mx-auto px-6 py-6" >
    <!-- Header -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8  ml-7">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manage Medicines</h1>
            <p class="mt-2 text-sm text-gray-500">
                Add, edit, and manage medicines in your inventory.
            </p>
        </div>

        <div class="mt-4 sm:mt-0">
            <a href="{{ route('admin.medicines.create') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 transition">

                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

                Add Medicine
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mx-6 overflow-hidden">

        <!-- Search -->
        <div class="p-5 border-b border-gray-100 flex justify-between items-center">

            <div class="relative w-full max-w-md">
                <input type="text"
                    placeholder="Search medicines..."
                    class="w-full rounded-lg border border-gray-200 pl-10 pr-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">

                <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m21 21-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z"/>
                </svg>
            </div>

            <div class="text-sm text-gray-500">
                Total Medicines: {{ $medicines->count() }}
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Image
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Medicine Name
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Category
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Price
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Stock
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">
                            Manufacturer
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase">
                            Actions
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($medicines as $medicine)

                    <tr class="hover:bg-gray-50">

                        <!-- Image -->
                        <td class="px-6 py-4">

                            @if($medicine->image)
                                <img
                                    src="{{ asset('storage/'.$medicine->image) }}"
                                    class="h-12 w-12 rounded-lg object-cover border"
                                    alt="">
                            @else
                                <div class="h-12 w-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                    <span class="text-xs text-gray-400">N/A</span>
                                </div>
                            @endif

                        </td>

                        <!-- Name -->
                        <td class="px-6 py-4 font-semibold text-gray-900">
                            {{ $medicine->name }}
                        </td>

                        <!-- Category -->
                        <td class="px-6 py-4 text-gray-600">
                            {{ $medicine->category->name ?? 'N/A' }}
                        </td>

                        <!-- Price -->
                        <td class="px-6 py-4 text-gray-600">
                            ₹{{ number_format($medicine->price, 2) }}
                        </td>

                        <!-- Stock -->
                        <td class="px-6 py-4">

                            @if($medicine->stock > 20)
                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">
                                    {{ $medicine->stock }} In Stock
                                </span>
                            @elseif($medicine->stock > 0)
                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-medium">
                                    {{ $medicine->stock }} Low Stock
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-medium">
                                    Out of Stock
                                </span>
                            @endif

                        </td>

                        <!-- Manufacturer -->
                        <td class="px-6 py-4 text-gray-600">
                            {{ $medicine->manufacturer }}
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 text-right">

                            <div class="flex justify-end gap-4">

                                <a href="{{ route('admin.medicines.edit', $medicine->id) }}"
                                    class="text-blue-600 hover:text-blue-800">
                                    Edit
                                </a>

                                <form method="POST"
                                    action="{{ route('admin.medicines.destroy',$medicine->id) }}"
                                    onsubmit="return confirm('Delete this medicine?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="text-red-600 hover:text-red-800">
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center py-12 text-gray-500">
                            No medicines found.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

@endsection