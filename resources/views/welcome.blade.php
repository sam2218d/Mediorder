<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MediOrder - Home</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-50 antialiased">

</body>

</html>

@include('layouts.navigation')



<div class="bg-white font-sans antialiased">

  <section class="relative bg-gray-50 py-12 sm:py-20 lg:py-32 overflow-hidden border-b border-gray-100">
    <div class="absolute inset-0 opacity-10 bg-cover bg-center"
      style="background-image: url('https://placehold.co/1920x1080/e2e8f0/e2e8f0');"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 tracking-tight leading-tight mb-4 sm:mb-6">
        Your health, delivered <br>
        <span class="text-emerald-700">safely & swiftly.</span>
      </h1>
      <p class="text-base sm:text-xl text-gray-600 mb-8 sm:mb-10 max-w-2xl mx-auto">
        Order prescription and over-the-counter medicines online. Genuine products, fast delivery, and expert care.
      </p>

      <form action="{{ route('medicines.search') }}" method="GET"
        class="max-w-2xl mx-auto bg-white rounded-full shadow-lg border border-gray-100 flex items-center p-2 mb-8">
        <div class="pl-4 text-gray-400">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
          </svg>
        </div>

        <input type="text" name="query" placeholder="Search for medicines..." required
          class="flex-1 w-full bg-transparent border-0 py-3 px-4 text-gray-900 focus:ring-0 placeholder-gray-400 outline-none">

        <button type="submit"
          class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-6 rounded-full flex items-center gap-2 transition-colors">
          Shop Now
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
          </svg>
        </button>
      </form>

      <div class="flex flex-wrap justify-center items-center gap-6 sm:gap-8 text-sm font-medium text-gray-600">
        <div class="flex items-center gap-2">
          <span class="w-2 h-2 rounded-full bg-emerald-500"></span> 100% Genuine Medicines
        </div>
        <div class="flex items-center gap-2">
          <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Fast Delivery
        </div>
        <div class="flex items-center gap-2">
          <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Secure Payments
        </div>
      </div>
    </div>
  </section>
  {{-- ===== FEATURED CATEGORIES ===== --}}
  <section class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-end mb-5">
      <div>
        <h2 class="text-2xl font-extrabold text-gray-900 border-b-2 border-emerald-700 pb-1 inline-block">
          Featured Categories
        </h2>
      </div>
      <a href="#" class="text-emerald-600 hover:text-emerald-700 font-semibold text-sm flex items-center gap-1">
        View All Categories &rarr;
      </a>
    </div>

    {{-- Single white card row --}}
    <div
      class="bg-white border border-gray-200 rounded-2xl overflow-hidden grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 divide-x divide-gray-100">
      @foreach($categories as $category)
        <a href="#" class="flex flex-col items-center justify-center gap-3 py-6 px-4 hover:bg-gray-50 transition-colors">
          <div class="w-16 h-16 rounded-full overflow-hidden flex items-center justify-center bg-gray-100 shrink-0">
            @if($category->image)
              <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                class="w-full h-full object-cover">
            @else
              <svg class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
              </svg>
            @endif
          </div>
          <span class="text-xs font-semibold text-gray-700 text-center leading-tight">{{ $category->name }}</span>
        </a>
      @endforeach
    </div>
  </section>


  {{-- ===== HOW TO ORDER ===== --}}


  {{-- ===== TOP MEDICINES ===== --}}
  <section class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-end mb-1">
      <div>
        <h2 class="text-2xl font-extrabold text-gray-900 border-b-2 border-emerald-700 pb-1 inline-block">
          Top Medicines
        </h2>
      </div>
      <a href="#" class="text-emerald-600 hover:text-emerald-700 font-semibold text-sm flex items-center gap-1">
        View All &rarr;
      </a>
    </div>
    <p class="text-xs font-semibold text-amber-500 flex items-center gap-1 mb-6">
      <svg class="w-3.5 h-3.5 fill-amber-400" viewBox="0 0 24 24">
        <path d="M12 2l2.9 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l7.1-1.01L12 2z" />
      </svg>
      Recommended essentials for your home pharmacy
    </p>

    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
      @foreach($medicines as $medicine)
        <div
          class="bg-white border border-gray-200 rounded-2xl overflow-hidden flex flex-col hover:shadow-md transition-shadow">

          {{-- Image area with colored bg --}}
          <div class="relative h-32 sm:h-44 flex items-center justify-center p-3 sm:p-5
          @if($loop->index % 4 == 0) bg-amber-50
          @elseif($loop->index % 4 == 1) bg-blue-50
          @elseif($loop->index % 4 == 2) bg-teal-50
          @else bg-slate-50 @endif">



            @if($medicine->image)
              <img src="{{ asset('storage/' . $medicine->image) }}" alt="{{ $medicine->name }}"
                class="max-h-28 max-w-full object-contain">
            @else
              <img src="https://placehold.co/200x200/e2e8f0/94a3b8?text=💊" alt="Medicine"
                class="max-h-28 object-contain opacity-60">
            @endif
          </div>

          {{-- Card body --}}
          <div class="p-2.5 sm:p-3 flex flex-col flex-1">
            <p class="text-[9px] sm:text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5 sm:mb-1">
              {{ $medicine->brand ?? 'Generic' }}
            </p>
            <h3 class="text-xs sm:text-sm font-bold text-gray-900 leading-snug mb-2 sm:mb-3">
              {{ $medicine->name }}
            </h3>

            {{-- Price row --}}
            <div class="flex items-baseline gap-1 sm:gap-1.5 mb-2 sm:mb-3">
              <span class="text-sm sm:text-base font-extrabold" style="color: #0f6e56;">
                ₹{{ number_format($medicine->price, 2) }}
              </span>
              @if($medicine->original_price ?? false)
                <span class="text-xs text-gray-400 line-through">
                  ₹{{ number_format($medicine->original_price, 2) }}
                </span>
              @endif
            </div>

            {{-- Add to Cart button --}}


            <button type="button" onclick="addToCart('{{ route('cart.add', $medicine->id) }}')"
              class="mt-auto w-full bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold py-2 sm:py-2.5 rounded-xl flex items-center justify-center gap-1.5 sm:gap-2 transition-colors text-xs sm:text-sm"
              style="background: #0f6e56; color: #fff;">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
              </svg>
              Add to Cart
            </button>

          </div>
        </div>
      @endforeach
    </div>
  </section>
  <section class="py-16 bg-gradient-to-b from-emerald-50/60 to-white border-t border-b border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Heading --}}
    <div class="text-center mb-12">
      <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-3">
        How to Order
      </h2>
      <p class="text-gray-500 text-sm sm:text-base max-w-xl mx-auto">
        Get your medicines delivered in just 4 simple steps
      </p>
    </div>

    {{-- Steps --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

      {{-- Step 1 --}}
      <div class="relative bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
        <span class="absolute -top-3 -left-3 w-8 h-8 rounded-full bg-emerald-600 text-white text-xs font-extrabold flex items-center justify-center shadow-md ring-4 ring-white">1</span>
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
          <svg class="w-8 h-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
          </svg>
        </div>
        <h3 class="text-base font-bold text-gray-900 mb-1">Search Medicine</h3>
        <p class="text-xs text-gray-500 leading-relaxed">Search for your required medicine by name, brand, or category.</p>
      </div>

      {{-- Connector (hidden on mobile) --}}

      {{-- Step 2 --}}
      <div class="relative bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
        <span class="absolute -top-3 -left-3 w-8 h-8 rounded-full bg-emerald-600 text-white text-xs font-extrabold flex items-center justify-center shadow-md ring-4 ring-white">2</span>
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition-colors">
          <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
          </svg>
        </div>
        <h3 class="text-base font-bold text-gray-900 mb-1">Upload Prescription</h3>
        <p class="text-xs text-gray-500 leading-relaxed">Upload a valid prescription for prescription-only medicines.</p>
      </div>

      {{-- Step 3 --}}
      <div class="relative bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
        <span class="absolute -top-3 -left-3 w-8 h-8 rounded-full bg-emerald-600 text-white text-xs font-extrabold flex items-center justify-center shadow-md ring-4 ring-white">3</span>
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-amber-50 flex items-center justify-center group-hover:bg-amber-100 transition-colors">
          <svg class="w-8 h-8 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>
          </svg>
        </div>
        <h3 class="text-base font-bold text-gray-900 mb-1">Place Your Order</h3>
        <p class="text-xs text-gray-500 leading-relaxed">Add items to your cart, choose payment method, and confirm your order.</p>
      </div>

      {{-- Step 4 --}}
      <div class="relative bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
        <span class="absolute -top-3 -left-3 w-8 h-8 rounded-full bg-emerald-600 text-white text-xs font-extrabold flex items-center justify-center shadow-md ring-4 ring-white">4</span>
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-teal-50 flex items-center justify-center group-hover:bg-teal-100 transition-colors">
          <svg class="w-8 h-8 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
          </svg>
        </div>
        <h3 class="text-base font-bold text-gray-900 mb-1">Fast Delivery</h3>
        <p class="text-xs text-gray-500 leading-relaxed">Sit back and relax. Your medicines will be delivered to your doorstep.</p>
      </div>

    </div>
  </div>
</section>


  @include('layouts.footer')
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @include('components.chatbot')

  <script>
    function addToCart(actionUrl) {
      // 1. Get the security token
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // 2. Silently send the exact same request your form would have sent
      fetch(actionUrl, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
        .then(response => {
          // 3. If Laravel successfully received it and processed it...
          if (response.ok) {
            // Find the badge
            let cartBadge = document.getElementById('cart-count');

            // Get the current number and add 1
            let currentNumber = parseInt(cartBadge.innerText);
            cartBadge.innerText = currentNumber + 1;

            // Add a little pop animation so the user knows it worked!
            cartBadge.classList.add('scale-150', 'transition-transform');
            setTimeout(() => cartBadge.classList.remove('scale-150'), 200);
          } else {
            console.error('Database failed to update.');
          }
        })
        .catch(error => {
          console.error('Network Error:', error);
        });
    }
  </script>

</div>