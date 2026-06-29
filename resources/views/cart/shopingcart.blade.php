<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@include('layouts.navigation')

    <!-- <div class="max-w-[110 -->
<body class="bg-[#fcfcfc] min-h-screen font-sans text-gray-900 pb-20">

   <div class="flex flex-col lg:flex-row gap-8 items-start">

    <div class="w-full lg:w-2/3 flex flex-col gap-5" style="max-width: 800px; margin: 0 auto;">
        
        @php $subtotal = 0; @endphp @if(session('cart') && count(session('cart')) > 0)
            
            @foreach(session('cart') as $id => $details)
                @php 
                    // Add this item's price * quantity to the total
                    $subtotal += $details['price'] * $details['quantity']; 
                @endphp

                <div class="flex flex-col sm:flex-row bg-white border border-gray-100 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.05)] rounded-2xl p-5 gap-6 items-start sm:items-center">
                    
                    <div class="w-[100px] h-[100px] bg-[#f5f6f5] rounded-xl flex-shrink-0 flex items-center justify-center relative overflow-hidden">
                        <img src="{{ asset('storage/'.$details['image']) }}" alt="{{ $details['name'] }}" class="object-cover w-full h-full">
                    </div>

                    <div class="flex-grow flex flex-col w-full h-full justify-between gap-4">
                        <div class="flex justify-between items-start w-full">
                            <div class="flex flex-col gap-1.5">
                                <h3 class="text-[17px] font-bold text-gray-900 leading-tight">{{ $details['name'] }}</h3>
                                
                                @if(isset($details['requires_prescription']) && $details['requires_prescription'])
                                    <div>
                                        <span class="inline-flex items-center text-[11px] font-bold text-[#d97706] border border-[#fcd34d] bg-[#fffbeb] px-2 py-0.5 rounded shadow-sm">
                                            Rx Required
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <p class="text-lg font-black text-gray-900">₹{{ number_format($details['price'], 2) }}</p>
                        </div>

                        <div class="flex justify-between items-end w-full">
                            <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden h-[34px]">
                                <span class="px-4 font-bold text-[13px] text-center flex items-center justify-center h-full text-gray-600">
                                    Qty: {{ $details['quantity'] }}
                                </span>
                            </div>

                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center gap-1.5 text-[#ef4444] hover:text-red-700 text-[13px] font-semibold transition-colors mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-white rounded-2xl p-10 text-center border border-gray-100 shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Your cart is empty</h3>
                <p class="text-gray-500 mb-6">Looks like you haven't added any medicines yet.</p>
                <a href="/products" class="inline-block bg-[#0bb877] text-white font-bold px-6 py-3 rounded-xl hover:bg-[#00a365] transition-colors">Browse Medicines</a>
            </div>
        @endif

    </div>

    <div class="w-full lg:w-1/3 bg-[#fbfcfb] border border-gray-100 rounded-[24px] p-7 lg:sticky lg:top-8 shadow-[0_4px_20px_-5px_rgba(0,0,0,0.03)]">
        
        @php
            // Calculate the final totals based on the subtotal we added up in the loop
            $shipping = $subtotal > 0 ? 4.99 : 0; // Only charge shipping if there are items
            $tax = $subtotal * 0.05; // Example: 5% tax rate
            $total = $subtotal + $shipping + $tax;
        @endphp

        <h2 class="text-[19px] font-black text-gray-900 mb-6">Order Summary</h2>

        <div class="flex flex-col gap-4 mb-6">
            <div class="flex justify-between text-gray-500 text-[15px]">
                <span>Subtotal</span>
                <span class="font-bold text-gray-900">₹{{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between text-gray-500 text-[15px]">
                <span>Shipping</span>
                <span class="font-bold text-gray-900">₹{{ number_format($shipping, 2) }}</span>
            </div>
            <div class="flex justify-between text-gray-500 text-[15px]">
                <span>Estimated Tax (5%)</span>
                <span class="font-bold text-gray-900">₹{{ number_format($tax, 2) }}</span>
            </div>
        </div>

        <div class="w-full h-px bg-gray-200 mb-5"></div>

        <div class="flex justify-between items-center mb-8">
            <span class="text-[17px] font-bold text-gray-900">Total</span>
            <span class="text-[26px] font-black text-[#00a86b] tracking-tight">₹{{ number_format($total, 2) }}</span>
        </div>

        <a href="/checkout" class="w-full bg-[#0bb877] hover:bg-[#00a365] text-white font-bold py-3.5 rounded-xl flex justify-center items-center gap-2 transition-colors mb-5 shadow-[0_4px_14px_0_rgba(11,184,119,0.25)] {{ $subtotal == 0 ? 'opacity-50 pointer-events-none' : '' }}">
            Proceed to Checkout
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 mt-0.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
        </a>
    </div>
</div>
</body>
@include('layouts.footer')

</html>