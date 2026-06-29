@extends('layouts.adminnav')

@section('content')
<div class="text-gray-800 p-4 md:p-8 w-full">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
            <div>
                <h1 class="text-[28px] font-bold text-gray-900 tracking-tight mb-1">Orders Management</h1>
                <p class="text-sm text-gray-500 font-medium">View, filter, and manage all customer orders.</p>
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <button class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 font-semibold py-2.5 px-4 rounded-xl flex items-center gap-2 transition-colors w-full md:w-auto justify-center shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    Export CSV
                </button>
            </div>
        </div>

        <div class="bg-white rounded-[24px] shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-gray-100 overflow-hidden flex flex-col">

            <div class="p-5 border-b border-gray-100 flex flex-col lg:flex-row gap-4 justify-between items-center bg-gray-50/30">

                <div class="relative w-full lg:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Search by Order ID, Name, or Email..." class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all bg-white">
                </div>

                <div class="flex gap-3 w-full lg:w-auto overflow-x-auto pb-1 lg:pb-0">
                    <select class="border border-gray-200 text-gray-700 bg-white py-2.5 px-4 rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 cursor-pointer min-w-[140px]">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>

                    <select class="border border-gray-200 text-gray-700 bg-white py-2.5 px-4 rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 cursor-pointer min-w-[140px]">
                        <option value="">Last 30 Days</option>
                        <option value="7">Last 7 Days</option>
                        <option value="90">Last 90 Days</option>
                        <option value="all">All Time</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap min-w-[1000px]">
                    <thead>
                        <tr class="bg-white text-[13px] text-gray-500 font-semibold border-b border-gray-100">
                            <th class="py-4 px-6 font-semibold">Order Details</th>
                            <th class="py-4 px-6 font-semibold">Customer</th>
                            <th class="py-4 px-6 font-semibold">Date & Time</th>
                            <th class="py-4 px-6 font-semibold">Payment</th>
                            <th class="py-4 px-6 font-semibold">Status</th>
                            <th class="py-4 px-6 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">

                        <tr class="border-b border-gray-50 hover:bg-gray-50/80 transition-colors">
                            @foreach($orders as $order)
                            <td class="py-4 px-6">
                                <div class="font-bold text-gray-900 mb-0.5">ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</div>
                                <div class="text-[12px] font-medium text-gray-500">{{ $order->items_count }} items • ${{ number_format($order->total_amount, 2) }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-semibold text-gray-900">{{ $order->first_name }} {{ $order->last_name }}</div>
                                <div class="text-[12px] text-gray-500">{{ $order->email }}</div>
                            </td>
                            <td class="py-4 px-6 text-gray-600 text-[13px]">
                                {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                            </td>
                            <td class="py-4 px-6">
                                @if($order->payment_proof_path)
                                <div class="flex items-center gap-1.5 text-emerald-600 bg-emerald-50 w-fit px-2.5 py-1 rounded-md text-[12px] font-bold border border-emerald-100">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    Proof Uploaded
                                </div>
                                @else
                                <div class="flex items-center gap-1.5 text-orange-600 bg-orange-50 w-fit px-2.5 py-1 rounded-md text-[12px] font-bold border border-orange-100">
                                    Pending Proof
                                </div>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-[12px] font-bold rounded-full
            @if($order->status == 'pending') text-orange-700 bg-orange-100
            @elseif($order->status == 'processing') text-blue-700 bg-blue-100
            @elseif($order->status == 'shipped') text-purple-700 bg-purple-100
            @elseif($order->status == 'delivered') text-emerald-700 bg-emerald-100
            @else text-red-700 bg-red-100 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center justify-end gap-2">
            <a href="{{ route('admin.orders.show', $order->id) }}" title="View Details" class="text-gray-400 hover:text-teal-600 hover:bg-teal-50 p-2 rounded-lg transition-colors inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </a>
        </div>
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4 bg-gray-50/30">
                <p class="text-[13px] text-gray-500 font-medium">
                    Showing <span class="font-bold text-gray-900">1</span> to <span class="font-bold text-gray-900">5</span> of <span class="font-bold text-gray-900">145</span> results
                </p>

                <div class="flex gap-2">
                    <button class="px-4 py-2 text-sm font-semibold text-gray-500 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        Previous
                    </button>
                    <button class="px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                        Next
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection