<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - MediOrder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] antialiased text-slate-800">

    @include('layouts.navigation')

    <main class="max-w-[1000px] mx-auto px-4 sm:px-6 lg:px-8 py-12 min-h-screen">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">My Orders</h1>
            <p class="text-slate-500 text-[15px]">View and manage your recent medication and health product orders.</p>
        </div>

        <div class="flex gap-6 sm:gap-8 border-b border-slate-200 mb-8 overflow-x-auto whitespace-nowrap hide-scrollbar">
            <button class="pb-4 border-b-2 border-[#0d5c46] text-[#0d5c46] font-bold text-sm px-1">
                All Orders
            </button>
            <button class="pb-4 border-b-2 border-transparent text-slate-500 hover:text-slate-800 font-semibold text-sm px-1 transition-colors">
                Active
            </button>
            <button class="pb-4 border-b-2 border-transparent text-slate-500 hover:text-slate-800 font-semibold text-sm px-1 transition-colors">
                Completed
            </button>
            <button class="pb-4 border-b-2 border-transparent text-slate-500 hover:text-slate-800 font-semibold text-sm px-1 transition-colors">
                Cancelled
            </button>
        </div>

        <div class="flex flex-col gap-6">

            @forelse($orders as $order)
                <div class="bg-white border border-slate-200 rounded-xl p-5 md:p-6 shadow-sm flex flex-col md:flex-row justify-between gap-6 hover:shadow-md transition-shadow">
                    
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-1.5">
                            <h3 class="text-[15px] font-bold text-slate-900">Order #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h3>
                            
                            @if($order->status == 'pending')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-orange-50 text-orange-700 text-[11px] font-bold tracking-wide">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Pending
                                </span>
                            @elseif($order->status == 'processing')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-[11px] font-bold tracking-wide">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                    Processing
                                </span>
                            @elseif($order->status == 'shipped')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-purple-50 text-purple-700 text-[11px] font-bold tracking-wide">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
                                    Shipped
                                </span>
                            @elseif($order->status == 'delivered')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-bold tracking-wide">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Delivered
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-red-50 text-red-700 text-[11px] font-bold tracking-wide uppercase">
                                    {{ $order->status }}
                                </span>
                            @endif
                        </div>
                        <p class="text-[13px] text-slate-500 mb-6">Placed on {{ $order->created_at->format('M d, Y') }}</p>

                        <div class="flex items-start gap-4">
                            <div class="flex gap-2 shrink-0">
                                @foreach($order->items->take(2) as $item)
                                    <div class="w-14 h-14 bg-slate-50 border border-slate-200 rounded-lg p-1.5 flex items-center justify-center">
                                        @if($item->item_image)
                                            <img src="{{ asset('storage/'.$item->item_image) }}" class="w-full h-full object-contain" alt="{{ $item->item_name }}">
                                        @else
                                            <svg class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>
                                @endforeach
                                
                                @if($order->items->count() > 2)
                                    <div class="w-14 h-14 bg-slate-100 border border-slate-200 rounded-lg flex items-center justify-center text-[13px] font-bold text-slate-600">
                                        +{{ $order->items->count() - 2 }}
                                    </div>
                                @endif
                            </div>
                            
                            <div class="pt-0.5">
                                <p class="text-[13px] font-bold text-slate-900 mb-1">
                                    {{ $order->status == 'delivered' ? 'Delivered' : 'Estimated Delivery: In Progress' }}
                                </p>
                                <p class="text-[13px] text-slate-500 leading-snug line-clamp-2 max-w-lg">
                                    {{ $order->items->pluck('item_name')->implode(', ') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-start md:items-end justify-between border-t md:border-t-0 border-slate-100 pt-5 md:pt-0">
                        <div class="text-left md:text-right w-full flex flex-row md:flex-col justify-between md:justify-start items-center md:items-end mb-4 md:mb-0">
                            <p class="text-[20px] font-bold text-slate-900">₹{{ number_format($order->total_amount, 2) }}</p>
                            <p class="text-[13px] font-medium text-slate-500 mt-0.5">{{ $order->items->count() }} Items</p>
                        </div>
                        
                        <div class="flex flex-col items-center md:items-end w-full md:w-auto gap-3">
                            @if($order->status == 'delivered')
                                <button class="w-full md:w-auto bg-[#0d5c46] hover:bg-[#0a4a38] text-white text-[13px] font-bold py-2 px-5 rounded-lg flex items-center justify-center gap-1.5 transition-colors shadow-sm">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                                    Reorder
                                </button>
                            @else
                                <button class="w-full md:w-auto bg-[#0d5c46] hover:bg-[#0a4a38] text-white text-[13px] font-bold py-2 px-5 rounded-lg flex items-center justify-center gap-1.5 transition-colors shadow-sm">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" /></svg>
                                    Track Order
                                </button>
                            @endif
                            
                            <a href="{{ route('myorders.track', $order->id) }}" class="text-[13px] font-bold text-[#0d5c46] hover:text-[#0a4a38] hover:underline transition-all">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            
            @empty
                <div class="text-center py-16 bg-white border border-slate-200 rounded-xl shadow-sm flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">No orders found</h3>
                    <p class="text-slate-500 mb-6 text-[14px]">You haven't placed any medication orders yet.</p>
                    <a href="/products" class="bg-[#0d5c46] hover:bg-[#0a4a38] text-white font-bold py-2.5 px-6 rounded-lg transition-colors shadow-sm">
                        Start Shopping
                    </a>
                </div>
            @endforelse </div>
    </main>

    @include('layouts.footer')

</body>
</html>