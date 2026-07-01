<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediOrder Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom scrollbar for a cleaner look */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Fixed summary sidebar on large screens */
        @media (min-width: 1024px) {
            .checkout-summary-col {
                position: fixed;
                right: max(1.5rem, calc((100vw - 80rem) / 2 + 1.5rem));
                top: 7rem;
                width: 400px;
                max-height: calc(100vh - 8rem);
                overflow-y: auto;
                z-index: 40;
            }
            .checkout-form-col {
                padding-right: 430px;
            }
        }
    </style>
</head>

<body class="bg-[#fafafa] font-sans text-gray-900 min-h-screen flex flex-col">

    <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="/cart" class="flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-gray-800 transition-colors w-1/3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Cart
            </a>

            <div class="flex items-center justify-center gap-2 w-1/3">
                <div class="bg-[#00a86b] text-white p-1 rounded font-bold text-lg w-8 h-8 flex items-center justify-center">M</div>
                <span class="text-xl font-black tracking-tight text-gray-900">MediOrder Checkout</span>
            </div>

            <div class="w-1/3"></div>
        </div>
    </header>

    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data" class="flex-grow max-w-7xl mx-auto w-full px-6 py-10 relative">
        @csrf
   
        <div class="w-full flex flex-col gap-6 checkout-form-col">

            <section class="bg-white border border-gray-200 rounded-2xl p-7 shadow-sm">
                <h2 class="text-lg font-bold text-gray-900 mb-5">Contact Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label for="first_name" class="block text-[13px] font-semibold text-gray-700 mb-1.5">First Name</label>
                        <input type="text" name="first_name" id="first_name" placeholder="Jane" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#00a86b] focus:ring-1 focus:ring-[#00a86b] transition-shadow">
                    </div>
                    <div>
                        <label for="last_name" class="block text-[13px] font-semibold text-gray-700 mb-1.5">Last Name</label>
                        <input type="text" name="last_name" id="last_name" placeholder="Doe" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#00a86b] focus:ring-1 focus:ring-[#00a86b] transition-shadow">
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-[13px] font-semibold text-gray-700 mb-1.5">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="jane@example.com" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#00a86b] focus:ring-1 focus:ring-[#00a86b] transition-shadow">
                </div>
            </section>

            <section class="bg-white border border-gray-200 rounded-2xl p-7 shadow-sm">
                <h2 class="text-lg font-bold text-gray-900 mb-5">Shipping Address</h2>

                {{-- Saved addresses picker --}}
                @if($savedAddresses->count() > 0)
                <div class="mb-5">
                    <label class="block text-[13px] font-semibold text-gray-700 mb-3">Your Saved Addresses</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3" id="address-list">
                        @foreach($savedAddresses as $addr)
                        <div class="address-card relative border-2 rounded-xl p-4 cursor-pointer transition-all duration-200 hover:border-[#00a86b]/50 hover:shadow-md group {{ $addr->is_default ? 'border-[#00a86b] bg-[#00a86b]/5 ring-1 ring-[#00a86b]/20' : 'border-gray-200 bg-white' }}"
                             data-id="{{ $addr->id }}"
                             data-street="{{ $addr->street_address }}"
                             data-city="{{ $addr->city }}"
                             data-state="{{ $addr->state }}"
                             data-zip="{{ $addr->zip_code }}"
                             onclick="selectAddress(this)">

                            {{-- Radio indicator --}}
                            <div class="flex items-start gap-3">
                                <div class="w-5 h-5 rounded-full border-2 flex-shrink-0 mt-0.5 flex items-center justify-center transition-all {{ $addr->is_default ? 'border-[#00a86b] bg-[#00a86b]' : 'border-gray-300 bg-white' }}" id="radio-{{ $addr->id }}">
                                    <div class="w-2 h-2 rounded-full bg-white {{ $addr->is_default ? '' : 'hidden' }}" id="radio-dot-{{ $addr->id }}"></div>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-[13px] font-bold text-gray-900">{{ $addr->label }}</span>
                                        @if($addr->is_default)
                                        <span class="text-[10px] font-bold text-[#00a86b] bg-[#00a86b]/10 px-1.5 py-0.5 rounded">DEFAULT</span>
                                        @endif
                                    </div>
                                    <p class="text-[12px] text-gray-600 leading-relaxed truncate">{{ $addr->street_address }}</p>
                                    <p class="text-[12px] text-gray-500">{{ $addr->city }}, {{ $addr->state }} {{ $addr->zip_code }}</p>
                                </div>
                            </div>

                            {{-- Delete button (using JS to avoid nested form) --}}
                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity" onclick="event.stopPropagation()">
                                <button type="button" onclick="deleteAddress({{ $addr->id }}, this)" class="w-7 h-7 rounded-full bg-red-50 hover:bg-red-100 flex items-center justify-center transition-colors" title="Delete address">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @endforeach

                        {{-- Add New Address card --}}
                        <div class="address-card border-2 border-dashed border-gray-300 rounded-xl p-4 cursor-pointer transition-all duration-200 hover:border-[#00a86b]/50 hover:bg-[#00a86b]/5 flex items-center justify-center gap-2 min-h-[100px]"
                             data-id="new"
                             onclick="selectNewAddress(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span class="text-sm font-semibold text-gray-500">Use New Address</span>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Address form fields --}}
                <div id="address-fields" class="{{ $savedAddresses->count() > 0 && $savedAddresses->where('is_default', true)->count() > 0 ? '' : '' }}">
                    <div class="mb-5">
                        <label for="street_address" class="block text-[13px] font-semibold text-gray-700 mb-1.5">Street Address</label>
                        <input type="text" name="street_address" id="street_address" placeholder="123 Health Ave" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#00a86b] focus:ring-1 focus:ring-[#00a86b] transition-shadow">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label for="city" class="block text-[13px] font-semibold text-gray-700 mb-1.5">City</label>
                            <input type="text" name="city" id="city" placeholder="Metropolis" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#00a86b] focus:ring-1 focus:ring-[#00a86b] transition-shadow">
                        </div>
                        <div>
                            <label for="state" class="block text-[13px] font-semibold text-gray-700 mb-1.5">State/Province</label>
                            <input type="text" name="state" id="state" placeholder="NY" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#00a86b] focus:ring-1 focus:ring-[#00a86b] transition-shadow">
                        </div>
                        <div>
                            <label for="zip_code" class="block text-[13px] font-semibold text-gray-700 mb-1.5">Zip Code</label>
                            <input type="text" name="zip_code" id="zip_code" placeholder="10001" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-[#00a86b] focus:ring-1 focus:ring-[#00a86b] transition-shadow">
                        </div>
                    </div>

                    {{-- Save address checkbox (only for new addresses) --}}
                    @auth
                    <div class="mt-5 flex items-center gap-3 p-3 bg-gray-50 rounded-lg border border-gray-100" id="save-address-row">
                        <input type="checkbox" name="save_address" id="save_address" value="1" checked class="w-4 h-4 text-[#00a86b] border-gray-300 rounded focus:ring-[#00a86b]">
                        <label for="save_address" class="text-[13px] text-gray-700 font-medium cursor-pointer">Save this address for future orders</label>
                        <select name="address_label" id="address_label" class="ml-auto text-[12px] border border-gray-200 rounded-md px-2 py-1 focus:outline-none focus:border-[#00a86b]">
                            <option value="Home"> Home</option>
                            <option value="Office">Office</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    @endauth
                </div>
            </section>

            <script>
                // Auto-fill the default address on page load
                document.addEventListener('DOMContentLoaded', function() {
                    const defaultCard = document.querySelector('.address-card[data-id]:not([data-id="new"])');
                    const hasDefault = document.querySelector('.address-card .bg-\\[\\#00a86b\\]');
                    if (hasDefault) {
                        const card = hasDefault.closest('.address-card');
                        if (card) {
                            fillAddressFields(card);
                            hideSaveRow();
                        }
                    }
                });

                function selectAddress(card) {
                    // Reset all cards
                    document.querySelectorAll('.address-card').forEach(c => {
                        c.classList.remove('border-[#00a86b]', 'bg-[#00a86b]/5', 'ring-1', 'ring-[#00a86b]/20');
                        c.classList.add('border-gray-200', 'bg-white');
                        const radio = c.querySelector('[id^="radio-"]');
                        const dot = c.querySelector('[id^="radio-dot-"]');
                        if (radio) {
                            radio.classList.remove('border-[#00a86b]', 'bg-[#00a86b]');
                            radio.classList.add('border-gray-300', 'bg-white');
                        }
                        if (dot) dot.classList.add('hidden');
                    });

                    // Highlight selected card
                    card.classList.remove('border-gray-200', 'bg-white');
                    card.classList.add('border-[#00a86b]', 'bg-[#00a86b]/5', 'ring-1', 'ring-[#00a86b]/20');
                    const radio = card.querySelector('[id^="radio-"]');
                    const dot = card.querySelector('[id^="radio-dot-"]');
                    if (radio) {
                        radio.classList.remove('border-gray-300', 'bg-white');
                        radio.classList.add('border-[#00a86b]', 'bg-[#00a86b]');
                    }
                    if (dot) dot.classList.remove('hidden');

                    // Fill form fields
                    fillAddressFields(card);
                    hideSaveRow();
                }

                function selectNewAddress(card) {
                    // Reset all cards
                    document.querySelectorAll('.address-card').forEach(c => {
                        c.classList.remove('border-[#00a86b]', 'bg-[#00a86b]/5', 'ring-1', 'ring-[#00a86b]/20');
                        c.classList.add('border-gray-200', 'bg-white');
                        const radio = c.querySelector('[id^="radio-"]');
                        const dot = c.querySelector('[id^="radio-dot-"]');
                        if (radio) {
                            radio.classList.remove('border-[#00a86b]', 'bg-[#00a86b]');
                            radio.classList.add('border-gray-300', 'bg-white');
                        }
                        if (dot) dot.classList.add('hidden');
                    });

                    // Highlight new card
                    card.classList.remove('border-gray-200', 'bg-white');
                    card.classList.add('border-[#00a86b]', 'bg-[#00a86b]/5');

                    // Clear form fields
                    document.getElementById('street_address').value = '';
                    document.getElementById('city').value = '';
                    document.getElementById('state').value = '';
                    document.getElementById('zip_code').value = '';

                    // Focus on street address
                    document.getElementById('street_address').focus();
                    showSaveRow();
                }

                function fillAddressFields(card) {
                    document.getElementById('street_address').value = card.dataset.street || '';
                    document.getElementById('city').value = card.dataset.city || '';
                    document.getElementById('state').value = card.dataset.state || '';
                    document.getElementById('zip_code').value = card.dataset.zip || '';
                }

                function hideSaveRow() {
                    const row = document.getElementById('save-address-row');
                    if (row) row.style.display = 'none';
                }

                function showSaveRow() {
                    const row = document.getElementById('save-address-row');
                    if (row) row.style.display = 'flex';
                }

                function deleteAddress(id, btn) {
                    if (!confirm('Delete this address?')) return;
                    fetch('/checkout/address/' + id, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                        }
                    }).then(function() {
                        const card = btn.closest('.address-card');
                        if (card) card.remove();
                    });
                }
            </script>

            <section class="bg-white border-2 border-yellow-400 rounded-2xl p-7 shadow-sm relative overflow-hidden">
                <div class="absolute inset-0 bg-yellow-50/30 pointer-events-none"></div>

                <div class="relative z-10 flex gap-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-yellow-600 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Prescription Required</h2>
                        <p class="text-[13px] text-gray-600 mt-1">One or more items in your order require a valid prescription. Please upload a clear photo or PDF of your doctor's prescription.</p>
                    </div>
                </div>

                <label for="prescription_file" class="relative z-10 mt-6 border-2 border-dashed border-yellow-300 rounded-xl bg-yellow-50/50 hover:bg-yellow-100/50 transition-colors p-8 flex flex-col items-center justify-center cursor-pointer group block w-full">
                    <input type="file" name="prescription_file" id="prescription_file" class="hidden" accept=".png,.jpg,.jpeg,.pdf" required>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 text-yellow-500 mb-3 group-hover:-translate-y-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>
                    <span class="text-sm font-bold text-yellow-800 mb-1">Click to upload prescription</span>
                    <span class="text-xs text-yellow-600 font-medium">SVG, PNG, JPG or PDF (MAX. 5MB)</span>
                </label>
            </section>

            <section class="bg-white border border-gray-200 rounded-2xl p-7 shadow-sm mb-10">
                <div class="flex gap-3 mb-6 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-[#00a86b]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                    </svg>
                    <h2 class="text-lg font-bold text-gray-900">Scan & Pay</h2>
                </div>

                <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
                    <div class="flex flex-col items-center shrink-0">
                        <div class="p-3 border-2 border-gray-200 rounded-xl bg-white shadow-sm mb-3">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=upi://pay?pa=merchant@upi&pn=MediOrder&am={{ $total }}" alt="Payment QR Code" class="w-36 h-36 object-contain">
                        </div>
                        <p class="text-[13px] font-bold text-gray-800">Scan with any UPI App</p>
                        <p class="text-[12px] text-gray-500">Google Pay, PhonePe, Paytm</p>
                    </div>

                    <div class="w-full flex-grow">
                        <label class="block text-[13px] font-semibold text-gray-700 mb-2">Upload Payment Screenshot *</label>
                        <label for="payment_proof" class="border-2 border-dashed border-[#00a86b] rounded-xl bg-[#00a86b]/5 hover:bg-[#00a86b]/10 transition-colors p-6 flex flex-col items-center justify-center cursor-pointer group block w-full h-36">
                            <input type="file" name="payment_proof" id="payment_proof" class="hidden" accept="image/*" required>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-[#00a86b] mb-2 group-hover:-translate-y-1 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                            <span class="text-sm font-bold text-[#00a86b] mb-1 text-center">Click to upload screenshot</span>
                            <span class="text-xs text-gray-500 font-medium">PNG, JPG (MAX. 5MB)</span>
                        </label>
                    </div>
                </div>
            </section>

        </div>

        <div class="w-full lg:w-[400px] shrink-0 checkout-summary-col">

            <div class="bg-white border border-gray-200 rounded-[24px] p-7 shadow-sm">

                <h2 class="text-[19px] font-black text-gray-900 mb-6">
                    Order Summary
                </h2>
                

                @foreach($cart as $item)
                
                <div class="flex items-center gap-4 mb-4">

                    <div class="w-12 h-12 rounded overflow-hidden border">
                        <img
                            src="{{ asset('storage/'.$item['image']) }}"
                            alt="{{ $item['name'] }}"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="flex-grow">
                        <h4 class="text-[13px] font-bold text-gray-900">
                            {{ $item['name'] }}
                        </h4>

                        <p class="text-[12px] text-gray-500">
                            Qty: {{ $item['quantity'] }}
                        </p>
                    </div>

                    <span class="text-[14px] font-bold text-gray-900">
                        ₹{{ number_format($item['price'], 2) }}
                    </span>

                </div>
                @endforeach

                <div class="w-full h-px bg-gray-200 my-5"></div>

                <div class="flex flex-col gap-3 mb-6">

                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-bold">
                            ₹{{ number_format($subtotal, 2) }}
                        </span>
                    </div>

                    <div class="flex justify-between text-gray-600">
                        <span>Shipping</span>
                        <span class="font-bold">
                            ₹{{ number_format($shipping, 2) }}
                        </span>
                    </div>

                    <div class="flex justify-between text-gray-600">
                        <span>Tax (5%)</span>
                        <span class="font-bold">
                            ₹{{ number_format($tax, 2) }}
                        </span>
                    </div>

                </div>

                <div class="w-full h-px bg-gray-200 my-5"></div>

                <div class="flex justify-between items-center mb-8">

                    <span class="text-[17px] font-bold text-gray-900">
                        Total
                    </span>
                       <input type="hidden" name="total_amount" value="{{ $total }}">
                    <span class="text-[24px] font-black text-[#00a86b]" id="total_amount">
                        ₹{{ number_format($total, 2) }}
                    </span>

                </div>

                <button
                    type="submit"
                    class="w-full bg-[#00a86b] hover:bg-[#00905a] transition-colors text-white font-bold py-3.5 rounded-xl flex justify-center items-center mb-4 shadow-sm">
                    Place Order Securely
                </button>

                <div class="flex items-center justify-center gap-1.5 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-4 h-4 text-[#00a86b]">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>

                    <span class="text-[11px] font-medium">
                        Secure, 256-bit encrypted checkout
                    </span>
                </div>

            </div>

        </div>

    </form>

</body>

</html>