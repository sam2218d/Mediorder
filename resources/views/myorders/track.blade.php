<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Order - MediOrder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] antialiased text-slate-800">

    @include('layouts.navigation')

    <main class="max-w-[1100px] mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-1">Track Order</p>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 flex items-center gap-3">
                    Order #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                </h1>
                <div class="flex items-center gap-2 mt-2 text-[14px] text-slate-600">
                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                    Placed on {{ $order->created_at->format('M d, Y') }}
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl p-3 flex items-center gap-4 shadow-sm w-full md:w-auto">
                <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide">Current Status</p>
                    <p class="text-[14px] font-bold text-blue-700 capitalize">{{ $order->status == 'shipped' ? 'In Transit' : $order->status }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            
            <div class="lg:col-span-2 flex flex-col gap-6">
                
                <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                    <h2 class="text-[18px] font-bold text-slate-900 mb-8">Delivery Progress</h2>
                    
                    <div class="relative max-w-2xl mx-auto">
                        <div class="absolute top-5 left-0 w-full h-1 bg-slate-100 rounded-full z-0"></div>
                        
                        @php
                            $progressWidth = '0%';
                            if($order->status == 'processing') $progressWidth = '33%';
                            if($order->status == 'shipped') $progressWidth = '66%';
                            if($order->status == 'delivered') $progressWidth = '100%';
                        @endphp
                        <div class="absolute top-5 left-0 h-1 bg-[#0d5c46] rounded-full z-0 transition-all duration-500" style="width: {{ $progressWidth }}"></div>

                        <div class="relative z-10 flex justify-between">
                            
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full bg-[#0d5c46] text-white flex items-center justify-center border-4 border-white mb-3 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <p class="text-[11px] sm:text-[13px] font-bold text-slate-900">Order Placed</p>
                                <p class="text-[10px] sm:text-[11px] font-medium text-slate-500 mt-1">{{ $order->created_at->format('h:i A') }}</p>
                            </div>

                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'bg-[#0d5c46] text-white' : 'bg-slate-200 text-slate-400' }} flex items-center justify-center border-4 border-white mb-3 shadow-sm transition-colors">
                                    @if(in_array($order->status, ['shipped', 'delivered']))
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    @else
                                        <span class="w-2.5 h-2.5 rounded-full {{ $order->status == 'processing' ? 'bg-white' : 'bg-slate-400' }}"></span>
                                    @endif
                                </div>
                                <p class="text-[11px] sm:text-[13px] font-bold {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'text-slate-900' : 'text-slate-400' }}">Processed</p>
                                @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                                    <p class="text-[11px] font-medium text-slate-500 mt-1">Confirmed</p>
                                @endif
                            </div>

                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full {{ in_array($order->status, ['shipped', 'delivered']) ? ($order->status == 'shipped' ? 'bg-blue-600 text-white shadow-[0_0_0_4px_rgba(37,99,235,0.15)]' : 'bg-[#0d5c46] text-white') : 'bg-slate-200 text-slate-400' }} flex items-center justify-center border-4 border-white mb-3 shadow-sm transition-colors">
                                    @if($order->status == 'delivered')
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    @elseif($order->status == 'shipped')
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
                                    @else
                                        <span class="w-2.5 h-2.5 rounded-full bg-slate-400"></span>
                                    @endif
                                </div>
                                <p class="text-[11px] sm:text-[13px] font-bold {{ in_array($order->status, ['shipped', 'delivered']) ? 'text-slate-900' : 'text-slate-400' }}">In Transit</p>
                                @if($order->status == 'shipped')
                                    <p class="text-[11px] font-bold text-blue-600 mt-1">Est. Tomorrow</p>
                                @endif
                            </div>

                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full {{ $order->status == 'delivered' ? 'bg-[#0d5c46] text-white' : 'bg-slate-200 text-slate-400' }} flex items-center justify-center border-4 border-white mb-3 shadow-sm transition-colors">
                                    @if($order->status == 'delivered')
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                    @endif
                                </div>
                                <p class="text-[11px] sm:text-[13px] font-bold {{ $order->status == 'delivered' ? 'text-slate-900' : 'text-slate-400' }}">Delivered</p>
                                @if($order->status != 'delivered')
                                    <p class="text-[11px] font-medium text-slate-400 mt-1">Pending</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 flex flex-col justify-between shadow-sm">
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-[#0d5c46]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <h3 class="text-[14px] font-bold text-slate-700">Estimated Delivery</h3>
                            </div>
                            <p class="text-2xl font-extrabold text-slate-900 mb-1">
                                {{ $order->status == 'delivered' ? 'Delivered' : 'Tomorrow' }}
                            </p>
                            @if($order->status != 'delivered')
                                <p class="text-[14px] font-medium text-slate-500">by 8:00 PM</p>
                            @else
                                <p class="text-[14px] font-medium text-slate-500">Successfully received</p>
                            @endif
                        </div>
                        <a href="#" class="inline-flex items-center gap-1.5 text-[13px] font-bold text-blue-600 hover:text-blue-800 mt-8 transition-colors">
                            Receive delivery updates 
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-6 flex flex-col justify-between shadow-sm">
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-[#0d5c46]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                <h3 class="text-[14px] font-bold text-slate-700">Delivery Address</h3>
                            </div>
                            <p class="text-[16px] font-bold text-slate-900 mb-1">Home</p>
                            <p class="text-[14px] leading-relaxed text-slate-500">
                                {{ $order->street_address }}<br>
                                {{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}
                            </p>
                        </div>
                        <a href="#" class="inline-flex items-center gap-1.5 text-[13px] font-bold text-blue-600 hover:text-blue-800 mt-6 transition-colors">
                            Add delivery instructions
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </a>
                    </div>
                </div>

                @if(in_array($order->status, ['shipped', 'delivered']))
                <div class="relative bg-slate-100 rounded-2xl border border-slate-200 h-64 overflow-hidden flex flex-col justify-end shadow-sm group">
                    <div class="absolute inset-0 bg-blue-50/50 opacity-80" style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 20px 20px;"></div>
                    
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-full h-full text-blue-300 opacity-60" preserveAspectRatio="none" viewBox="0 0 100 100"><path d="M10,90 Q40,40 90,10" stroke="currentColor" stroke-width="2" fill="none" stroke-dasharray="4 4" /></svg>
                        <div class="absolute w-8 h-8 bg-blue-600 rounded-full border-4 border-white shadow-lg animate-pulse"></div>
                    </div>

                    <div class="relative z-10 m-3 bg-white/90 backdrop-blur-md border border-white/40 rounded-xl p-3 sm:p-4 shadow-lg flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-200 border-2 border-white overflow-hidden shrink-0 shadow-sm">
                                <img src="https://i.pravatar.cc/150?img=33" alt="Driver" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wide">Driver</p>
                                <p class="text-[14px] font-bold text-slate-900">Michael T.</p>
                            </div>
                        </div>
                        <button class="bg-[#0d5c46] hover:bg-[#0a4a38] text-white px-4 py-2 rounded-lg text-[13px] font-bold flex items-center gap-1.5 transition-colors shadow-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            Contact
                        </button>
                    </div>
                </div>
                @endif
            </div>

            <div class="flex flex-col gap-6">
                
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-6">
                        <svg class="w-5 h-5 text-[#0d5c46]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        <h3 class="text-[16px] font-bold text-slate-900">Order Summary</h3>
                    </div>

                    <div class="flex flex-col gap-5">
                        @foreach($order->items as $item)
                        <div class="flex gap-4">
                            <div class="w-14 h-14 bg-slate-50 border border-slate-100 rounded-lg p-1.5 shrink-0 flex items-center justify-center relative">
                                @if($item->item_image)
                                    <img src="{{ asset('storage/'.$item->item_image) }}" class="w-full h-full object-contain" alt="{{ $item->item_name }}">
                                @else
                                    <svg class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                @endif
                            </div>
                            <div class="flex flex-col justify-center">
                                <p class="text-[13px] font-bold text-slate-900 leading-tight mb-0.5">{{ $item->item_name }}</p>
                                <p class="text-[11px] text-slate-500 mb-1">Standard Item</p> 
                                <p class="text-[12px] font-bold text-[#0d5c46]">Qty: {{ $item->quantity }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="w-full h-px bg-slate-100 my-5"></div>

                    <div class="flex justify-between items-center">
                        <span class="text-[14px] font-medium text-slate-600">Total Items</span>
                        <span class="text-[15px] font-bold text-slate-900">{{ $order->items->sum('quantity') }}</span>
                    </div>
                </div>

                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 text-center shadow-sm">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <h3 class="text-[15px] font-bold text-slate-900 mb-2">Need help with your delivery?</h3>
                    <p class="text-[13px] text-slate-500 mb-5 leading-relaxed">
                        Our pharmacy support team is available 24/7 to assist you.
                    </p>
                    <a href="#" class="block w-full bg-white border border-blue-200 text-blue-700 hover:bg-blue-50 font-bold py-2.5 rounded-xl text-[13px] transition-colors shadow-sm">
                        Contact Support
                    </a>
                </div>

            </div>
        </div>
    </main>

    @include('layouts.footer')

</body>
</html>