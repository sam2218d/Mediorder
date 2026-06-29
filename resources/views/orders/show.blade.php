<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - MediOrder Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-emerald-100 selection:text-emerald-900">
            
<div class="min-h-screen flex">

    <aside class="hidden lg:flex flex-col w-64 fixed inset-y-0 bg-[#0F172A] z-50 shadow-2xl">
        
        <div class="h-20 flex items-center px-6 shrink-0 border-b border-slate-800/50">
            <div class="bg-gradient-to-br from-emerald-400 to-emerald-600 text-white rounded-xl w-9 h-9 flex items-center justify-center font-bold text-lg mr-3 shadow-lg shadow-emerald-500/20">M</div>
            <span class="text-xl font-bold text-white tracking-tight">MediOrder</span>
        </div>

        <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5">
            <a href="{{ url('/admin/dashboard') }}" class="text-slate-400 hover:bg-slate-800 hover:text-white group flex items-center px-3 py-2.5 text-[14px] font-medium rounded-xl transition-all duration-200">
                <svg class="mr-3 h-5 w-5 shrink-0 opacity-70 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                Dashboard
            </a>
            
            <a href="{{ url('/admin/medicines') }}" class="text-slate-400 hover:bg-slate-800 hover:text-white group flex items-center px-3 py-2.5 text-[14px] font-medium rounded-xl transition-all duration-200">
                <svg class="mr-3 h-5 w-5 shrink-0 opacity-70 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12.75 10.5v.75m0-2.25v.75m0 0v.75m0-1.5h.75m-.75 0h-.75M19.5 10.5A9 9 0 111.5 10.5a9 9 0 0118 0z" /></svg>
                Medicines
            </a>

            <a href="{{ url('/admin/orders') }}" class="bg-emerald-500/10 text-emerald-400 group flex items-center px-3 py-2.5 text-[14px] font-semibold rounded-xl transition-all duration-200 border border-emerald-500/20">
                <svg class="mr-3 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" /></svg>
                Orders
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800/50 bg-[#0F172A] mt-auto">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-emerald-400 to-emerald-600 flex items-center justify-center text-white font-bold text-sm shrink-0 shadow-lg">AU</div>
                <div class="flex flex-col overflow-hidden">
                    <span class="text-[13px] font-bold text-white truncate">Admin User</span>
                    <span class="text-[11px] text-slate-400 font-medium truncate">admin@mediorder.com</span>
                </div>
            </div>
        </div>
    </aside>

    <div class="flex-1 lg:pl-64 flex flex-col min-w-0">
        
        <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-xl border-b border-slate-200 h-20 flex items-center justify-between px-4 sm:px-6 lg:px-8 shadow-sm">
            
            <button class="lg:hidden text-slate-500 hover:text-slate-900 mr-4 transition-colors">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            </button>

            <div class="flex-1 w-full max-w-2xl">
                <div class="relative group">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="h-4 w-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors duration-300" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" /></svg>
                    </div>
                    <input type="search" placeholder="Search orders, medicines, customers..." class="block w-full rounded-xl border border-slate-200 py-2.5 pl-11 pr-4 text-slate-900 bg-slate-50/50 hover:bg-white focus:bg-white focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 text-[14px] font-medium transition-all duration-300">
                </div>
            </div>

            <div class="flex items-center ml-auto pl-4">
                <button class="relative p-2.5 text-slate-400 hover:text-slate-600 transition-colors rounded-full hover:bg-slate-100">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>
                    <span class="absolute top-2 right-2 block h-2.5 w-2.5 rounded-full bg-rose-500 ring-2 ring-white"></span>
                </button>
            </div>
        </header>

        <main class="p-4 md:p-8 w-full max-w-7xl mx-auto flex-1">
    
            <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-5">
                <div>
                    <a href="{{ route('admin.orders.index') ?? '#' }}" class="inline-flex items-center gap-1.5 text-[13px] font-bold text-slate-500 hover:text-emerald-600 transition-colors mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                        Back to Orders
                    </a>
                    <div class="flex items-center gap-4">
                        <h1 class="text-[32px] md:text-[36px] font-extrabold text-slate-900 tracking-tight leading-none">Order #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h1>
                        <span class="inline-flex items-center px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-widest rounded-full shadow-sm
                            @if($order->status == 'pending') bg-orange-100 text-orange-700 border border-orange-200/60
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-700 border border-blue-200/60
                            @elseif($order->status == 'shipped') bg-purple-100 text-purple-700 border border-purple-200/60
                            @elseif($order->status == 'delivered') bg-emerald-100 text-emerald-700 border border-emerald-200/60
                            @else bg-rose-100 text-rose-700 border border-rose-200/60 @endif">
                            {{ $order->status }}
                        </span>
                    </div>
                    <p class="text-[14px] text-slate-500 font-medium mt-2">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                </div>

                <div class="bg-white p-2.5 rounded-2xl shadow-sm border border-slate-200/60 flex items-center">
                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="flex items-center gap-2 m-0 w-full">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="border border-slate-200 text-slate-700 bg-slate-50 py-2.5 px-4 rounded-xl text-[14px] font-bold focus:outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 cursor-pointer min-w-[160px] transition-all">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-bold py-2.5 px-6 rounded-xl text-[14px] transition-all shadow-md shadow-slate-900/10 whitespace-nowrap">
                            Update
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 xl:gap-8">
                
                <div class="lg:col-span-2 flex flex-col gap-6 xl:gap-8">
                    
                    <div class="bg-white rounded-[24px] shadow-sm shadow-slate-200/50 border border-slate-200/60 overflow-hidden">
                        <div class="px-7 py-6 border-b border-slate-100 bg-white flex items-center justify-between">
                            <h2 class="text-[17px] font-bold text-slate-900">Items Ordered</h2>
                            <span class="text-sm font-medium text-slate-500">{{ $order->items->count() }} items</span>
                        </div>
                        
                        <div class="p-7 flex flex-col gap-4 bg-slate-50/30">
                            @forelse($order->items as $item)
                            <div class="flex items-center justify-between border border-slate-200/60 rounded-2xl p-4 bg-white hover:border-slate-300 hover:shadow-md hover:shadow-slate-200/40 transition-all duration-300">
                                <div class="flex items-center gap-5">
                                    <div class="w-16 h-16 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center overflow-hidden shrink-0 shadow-sm p-1.5">
                                        @if($item->item_image)
                                            <img src="{{ asset('storage/' . $item->item_image) }}" alt="{{ $item->item_name }}" class="w-full h-full object-contain rounded-lg">
                                        @else
                                            <svg class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-[15px]">{{ $item->item_name }}</h4>
                                        <p class="text-[13px] font-semibold text-slate-500 mt-1">
                                            Qty: {{ $item->quantity }} <span class="mx-1 text-slate-300">|</span> ₹{{ number_format($item->price, 2) }} each
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-slate-900 text-[16px]">₹{{ number_format($item->quantity * $item->price, 2) }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <p class="text-sm font-medium text-slate-500">No items found for this order.</p>
                            </div>
                            @endforelse
                        </div>

                        <div class="bg-white p-7 border-t border-slate-100">
                            <div class="flex flex-col gap-3.5 w-full max-w-sm ml-auto">
                                <div class="flex justify-between text-[14px]">
                                    <span class="text-slate-500 font-medium">Subtotal</span>
                                    <span class="font-bold text-slate-900">₹{{ number_format(($order->total_amount - 50), 2) }}</span> </div>
                                <div class="flex justify-between text-[14px]">
                                    <span class="text-slate-500 font-medium">Shipping Fee</span>
                                    <span class="font-bold text-slate-900">₹50.00</span>
                                </div>
                                <div class="w-full h-px bg-slate-100 my-2"></div>
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-slate-900 text-[16px]">Total Paid</span>
                                    <span class="font-black text-emerald-600 text-[22px]">₹{{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 xl:gap-8">
                        <div class="bg-white rounded-[24px] shadow-sm shadow-slate-200/50 border border-slate-200/60 p-7 relative overflow-hidden group hover:border-teal-200 transition-colors duration-300">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-teal-50 to-transparent rounded-bl-full -mr-4 -mt-4 opacity-70 z-0"></div>
                            <div class="relative z-10">
                                <div class="flex items-center gap-3.5 mb-6">
                                    <div class="w-11 h-11 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shadow-inner">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                                    </div>
                                    <h2 class="text-[16px] font-bold text-slate-900">Customer Details</h2>
                                </div>
                                <div class="text-[14px] font-medium text-slate-600 flex flex-col gap-3">
                                    <p class="font-bold text-slate-900 text-[17px]">{{ $order->first_name }} {{ $order->last_name }}</p>
                                    <p class="flex items-center gap-2.5">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg> 
                                        {{ $order->email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-[24px] shadow-sm shadow-slate-200/50 border border-slate-200/60 p-7 relative overflow-hidden group hover:border-blue-200 transition-colors duration-300">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-blue-50 to-transparent rounded-bl-full -mr-4 -mt-4 opacity-70 z-0"></div>
                            <div class="relative z-10">
                                <div class="flex items-center gap-3.5 mb-6">
                                    <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shadow-inner">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
                                    </div>
                                    <h2 class="text-[16px] font-bold text-slate-900">Shipping Address</h2>
                                </div>
                                <div class="text-[14px] font-medium text-slate-600 flex flex-col gap-2 leading-relaxed">
                                    <p class="font-bold text-slate-900 text-[15px]">{{ $order->street_address }}</p>
                                    <p>{{ $order->city }}, {{ $order->state }}</p>
                                    <p>Zip: <span class="font-semibold text-slate-700">{{ $order->zip_code }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1 flex flex-col gap-6 xl:gap-8">
                    
                    <div class="bg-white rounded-[24px] shadow-sm shadow-slate-200/50 border border-slate-200/60 p-7 flex flex-col h-full">
                        <div class="flex items-center gap-3.5 mb-6">
                            <div class="w-11 h-11 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center shrink-0 shadow-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                            </div>
                            <h2 class="text-[16px] font-bold text-slate-900 leading-tight">Prescription Upload</h2>
                        </div>
                        
                        @if($order->prescription_path)
                            <a href="{{ asset('storage/' . $order->prescription_path) }}" target="_blank" class="block w-full flex-grow bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl overflow-hidden group relative hover:border-orange-300 hover:bg-orange-50/20 transition-all duration-300 min-h-[220px]">
                                <img src="{{ asset('storage/' . $order->prescription_path) }}" alt="Prescription Document" class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity absolute inset-0">
                                <div class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-[2px]">
                                    <span class="bg-white text-slate-900 font-bold py-2.5 px-6 rounded-xl text-[14px] flex items-center gap-2 shadow-xl transform translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                                        View Full Image
                                    </span>
                                </div>
                            </a>
                        @else
                            <div class="flex-grow flex flex-col items-center justify-center bg-slate-50/50 rounded-2xl border-2 border-dashed border-slate-200 text-sm font-medium text-slate-400 p-8 text-center min-h-[220px]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mb-3 opacity-40"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" /></svg>
                                No prescription uploaded.
                            </div>
                        @endif
                    </div>

                    <div class="bg-white rounded-[24px] shadow-sm shadow-slate-200/50 border border-slate-200/60 p-7 flex flex-col h-full">
                        <div class="flex items-center gap-3.5 mb-6">
                            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 shadow-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                            </div>
                            <h2 class="text-[16px] font-bold text-slate-900 leading-tight">Payment Proof</h2>
                        </div>
                        
                        @if($order->payment_proof_path)
                            <a href="{{ asset('storage/' . $order->payment_proof_path) }}" target="_blank" class="block w-full flex-grow bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl overflow-hidden group relative hover:border-emerald-300 hover:bg-emerald-50/20 transition-all duration-300 min-h-[220px]">
                                <img src="{{ asset('storage/' . $order->payment_proof_path) }}" alt="Payment Screenshot" class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity absolute inset-0">
                                <div class="absolute inset-0 bg-slate-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-[2px]">
                                    <span class="bg-white text-slate-900 font-bold py-2.5 px-6 rounded-xl text-[14px] flex items-center gap-2 shadow-xl transform translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                                        View Full Image
                                    </span>
                                </div>
                            </a>
                        @else
                            <div class="flex-grow flex flex-col items-center justify-center bg-slate-50/50 rounded-2xl border-2 border-dashed border-slate-200 text-sm font-medium text-slate-400 p-8 text-center min-h-[220px]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mb-3 opacity-40"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" /></svg>
                                No payment proof uploaded.
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>