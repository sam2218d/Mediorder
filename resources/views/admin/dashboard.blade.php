@extends('layouts.adminnav')

@section('content')
<div class="text-gray-800 p-4 md:p-8 w-full">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
            <h1 class="text-[28px] font-bold text-gray-900 tracking-tight">Dashboard Overview</h1>
            <span class="text-sm text-gray-500 font-medium">Last updated: Just now</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-gray-100 flex items-center gap-5">
                <div class="w-14 h-14 rounded-xl bg-teal-50 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-teal-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[13px] font-semibold text-gray-500 mb-1">Total Orders Today</p>
                    <h3 class="text-2xl font-bold text-gray-900">145</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-gray-100 flex items-center gap-5">
                <div class="w-14 h-14 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-emerald-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[13px] font-semibold text-gray-500 mb-1">Total Revenue</p>
                    <h3 class="text-2xl font-bold text-gray-900">$4,250</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-gray-100 flex items-center gap-5">
                <div class="w-14 h-14 rounded-xl bg-orange-50 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-orange-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[13px] font-semibold text-gray-500 mb-1">Pending Prescriptions</p>
                    <h3 class="text-2xl font-bold text-gray-900">12</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-gray-100 flex items-center gap-5">
                <div class="w-14 h-14 rounded-xl bg-red-50 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 text-red-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[13px] font-semibold text-gray-500 mb-1">Low Stock Medicines</p>
                    <h3 class="text-2xl font-bold text-gray-900">8</h3>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-gray-100 xl:col-span-2 overflow-hidden">
                <div class="flex justify-between items-center p-6 border-b border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900">Recent Orders</h2>
                    <a href="#" class="text-sm font-semibold text-teal-600 hover:text-teal-700">View All</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-white text-[13px] text-gray-500 font-semibold border-b border-gray-100">
                                <th class="py-4 px-6 font-semibold">Order ID</th>
                                <th class="py-4 px-6 font-semibold">Customer</th>
                                <th class="py-4 px-6 font-semibold">Date</th>
                                <th class="py-4 px-6 font-semibold">Total</th>
                                <th class="py-4 px-6 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="py-4 px-6 font-medium text-gray-900">ORD-1023</td>
                                <td class="py-4 px-6 text-gray-600">John Doe</td>
                                <td class="py-4 px-6 text-gray-500">Today, 10:42 AM</td>
                                <td class="py-4 px-6 font-bold text-gray-900">$120.00</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex px-3 py-1 text-[12px] font-bold text-orange-700 bg-orange-100 rounded-full">Pending</span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="py-4 px-6 font-medium text-gray-900">ORD-1022</td>
                                <td class="py-4 px-6 text-gray-600">Jane Smith</td>
                                <td class="py-4 px-6 text-gray-500">Today, 09:15 AM</td>
                                <td class="py-4 px-6 font-bold text-gray-900">$45.50</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex px-3 py-1 text-[12px] font-bold text-blue-700 bg-blue-100 rounded-full">Processing</span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="py-4 px-6 font-medium text-gray-900">ORD-1021</td>
                                <td class="py-4 px-6 text-gray-600">Bob Johnson</td>
                                <td class="py-4 px-6 text-gray-500">Yesterday</td>
                                <td class="py-4 px-6 font-bold text-gray-900">$89.99</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex px-3 py-1 text-[12px] font-bold text-purple-700 bg-purple-100 rounded-full">Shipped</span>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="py-4 px-6 font-medium text-gray-900">ORD-1020</td>
                                <td class="py-4 px-6 text-gray-600">Alice Brown</td>
                                <td class="py-4 px-6 text-gray-500">Yesterday</td>
                                <td class="py-4 px-6 font-bold text-gray-900">$210.00</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex px-3 py-1 text-[12px] font-bold text-emerald-700 bg-emerald-100 rounded-full">Delivered</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="py-4 px-6 font-medium text-gray-900">ORD-1019</td>
                                <td class="py-4 px-6 text-gray-600">Charlie Davis</td>
                                <td class="py-4 px-6 text-gray-500">May 15</td>
                                <td class="py-4 px-6 font-bold text-gray-900">$34.00</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex px-3 py-1 text-[12px] font-bold text-emerald-700 bg-emerald-100 rounded-full">Delivered</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] border border-gray-100 xl:col-span-1 flex flex-col">
                <div class="flex justify-between items-center p-6 border-b border-gray-100">
                    <h2 class="text-lg font-bold text-gray-900">Pending Prescriptions</h2>
                    <span class="text-[11px] font-bold text-orange-700 bg-orange-100 px-2 py-1 rounded">12 Action Required</span>
                </div>
                
                <div class="grid grid-cols-12 px-6 py-3 bg-white border-b border-gray-100 text-[12px] font-semibold text-gray-500">
                    <div class="col-span-5">Customer</div>
                    <div class="col-span-4 text-left">Uploaded</div>
                    <div class="col-span-3 text-right">Action</div>
                </div>

                <div class="flex-grow overflow-y-auto">
                    
                    <div class="grid grid-cols-12 px-6 py-4 border-b border-gray-50 items-center hover:bg-gray-50/50 transition-colors">
                        <div class="col-span-5">
                            <p class="text-sm font-semibold text-gray-900 truncate">Sarah Wilson</p>
                            <p class="text-[11px] font-medium text-gray-400 mt-0.5">RX-409</p>
                        </div>
                        <div class="col-span-4">
                            <span class="text-[13px] text-gray-500">10 mins ago</span>
                        </div>
                        <div class="col-span-3 flex justify-end gap-2 md:gap-3">
                            <button class="text-emerald-500 hover:bg-emerald-50 p-1.5 rounded transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </button>
                            <button class="text-red-500 hover:bg-red-50 p-1.5 rounded transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 px-6 py-4 border-b border-gray-50 items-center hover:bg-gray-50/50 transition-colors">
                        <div class="col-span-5">
                            <p class="text-sm font-semibold text-gray-900 truncate">Michael Lee</p>
                            <p class="text-[11px] font-medium text-gray-400 mt-0.5">RX-408</p>
                        </div>
                        <div class="col-span-4">
                            <span class="text-[13px] text-gray-500">45 mins ago</span>
                        </div>
                        <div class="col-span-3 flex justify-end gap-2 md:gap-3">
                            <button class="text-emerald-500 hover:bg-emerald-50 p-1.5 rounded transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </button>
                            <button class="text-red-500 hover:bg-red-50 p-1.5 rounded transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 px-6 py-4 border-b border-gray-50 items-center hover:bg-gray-50/50 transition-colors">
                        <div class="col-span-5">
                            <p class="text-sm font-semibold text-gray-900 truncate">Emma Thomas</p>
                            <p class="text-[11px] font-medium text-gray-400 mt-0.5">RX-407</p>
                        </div>
                        <div class="col-span-4">
                            <span class="text-[13px] text-gray-500">2 hours ago</span>
                        </div>
                        <div class="col-span-3 flex justify-end gap-2 md:gap-3">
                            <button class="text-emerald-500 hover:bg-emerald-50 p-1.5 rounded transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </button>
                            <button class="text-red-500 hover:bg-red-50 p-1.5 rounded transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 px-6 py-4 border-b border-gray-50 items-center hover:bg-gray-50/50 transition-colors">
                        <div class="col-span-5">
                            <p class="text-sm font-semibold text-gray-900 truncate">David White</p>
                            <p class="text-[11px] font-medium text-gray-400 mt-0.5">RX-406</p>
                        </div>
                        <div class="col-span-4">
                            <span class="text-[13px] text-gray-500">3 hours ago</span>
                        </div>
                        <div class="col-span-3 flex justify-end gap-2 md:gap-3">
                            <button class="text-emerald-500 hover:bg-emerald-50 p-1.5 rounded transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </button>
                            <button class="text-red-500 hover:bg-red-50 p-1.5 rounded transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 px-6 py-4 items-center hover:bg-gray-50/50 transition-colors">
                        <div class="col-span-5">
                            <p class="text-sm font-semibold text-gray-900 truncate">Sophia Taylor</p>
                            <p class="text-[11px] font-medium text-gray-400 mt-0.5">RX-405</p>
                        </div>
                        <div class="col-span-4">
                            <span class="text-[13px] text-gray-500">5 hours ago</span>
                        </div>
                        <div class="col-span-3 flex justify-end gap-2 md:gap-3">
                            <button class="text-emerald-500 hover:bg-emerald-50 p-1.5 rounded transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                            </button>
                            <button class="text-red-500 hover:bg-red-50 p-1.5 rounded transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection