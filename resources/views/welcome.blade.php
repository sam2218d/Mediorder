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

  <section class="relative bg-gray-50 py-20 lg:py-32 overflow-hidden border-b border-gray-100">
    <div class="absolute inset-0 opacity-10 bg-cover bg-center" style="background-image: url('https://placehold.co/1920x1080/e2e8f0/e2e8f0');"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 tracking-tight leading-tight mb-6">
        Your health, delivered <br>
        <span class="text-emerald-700">safely & swiftly.</span>
      </h1>
      <p class="text-lg sm:text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
        Order prescription and over-the-counter medicines online. Genuine products, fast delivery, and expert care.
      </p>

      <div class="max-w-2xl mx-auto bg-white rounded-full shadow-lg border border-gray-100 flex items-center p-2 mb-8">
        <div class="pl-4 text-gray-400">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
          </svg>
        </div>
        <input type="text" placeholder="Search for medicines..." class="flex-1 w-full bg-transparent border-0 py-3 px-4 text-gray-900 focus:ring-0 placeholder-gray-400 outline-none">
        <button class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-3 px-6 rounded-full flex items-center gap-2 transition-colors">
          Shop Now
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
          </svg>
        </button>
      </div>

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
  <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 divide-x divide-gray-100">
    @foreach($categories as $category)
    <a href="#" class="flex flex-col items-center justify-center gap-3 py-6 px-4 hover:bg-gray-50 transition-colors">
      <div class="w-16 h-16 rounded-full overflow-hidden flex items-center justify-center bg-gray-100 shrink-0">
        @if($category->image)
          <img src="{{ asset('storage/'.$category->image) }}"
               alt="{{ $category->name }}"
               class="w-full h-full object-cover">
        @else
          <svg class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
          </svg>
        @endif
      </div>
      <span class="text-xs font-semibold text-gray-700 text-center leading-tight">{{ $category->name }}</span>
    </a>
    @endforeach
  </div>
</section>


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
    <svg class="w-3.5 h-3.5 fill-amber-400" viewBox="0 0 24 24"><path d="M12 2l2.9 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l7.1-1.01L12 2z"/></svg>
    Recommended essentials for your home pharmacy
  </p>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    @foreach($medicines as $medicine)
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden flex flex-col hover:shadow-md transition-shadow">

      {{-- Image area with colored bg --}}
      <div class="relative h-44 flex items-center justify-center p-5
        @if($loop->index % 4 == 0) bg-amber-50
        @elseif($loop->index % 4 == 1) bg-blue-50
        @elseif($loop->index % 4 == 2) bg-teal-50
        @else bg-slate-50 @endif">

        {{-- Rx badge --}}
        @if($medicine->requires_prescription ?? false)
          <span class="absolute top-3 left-3 bg-orange-500 text-white text-[9px] font-bold px-2 py-0.5 rounded uppercase tracking-wide">
            Rx Required
          </span>
        @endif

        @if($medicine->image)
          <img src="{{ asset('storage/'.$medicine->image) }}"
               alt="{{ $medicine->name }}"
               class="max-h-28 max-w-full object-contain">
        @else
          <img src="https://placehold.co/200x200/e2e8f0/94a3b8?text=💊"
               alt="Medicine"
               class="max-h-28 object-contain opacity-60">
        @endif
      </div>

      {{-- Card body --}}
      <div class="p-3 flex flex-col flex-1">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">
          {{ $medicine->brand ?? 'Generic' }}
        </p>
        <h3 class="text-sm font-bold text-gray-900 leading-snug mb-3">
          {{ $medicine->name }}
        </h3>

        {{-- Price row --}}
        <div class="flex items-baseline gap-1.5 mb-3">
          <span class="text-base font-extrabold" style="color: #0f6e56;">
            ₹{{ number_format($medicine->price, 2) }}
          </span>
          @if($medicine->original_price ?? false)
            <span class="text-xs text-gray-400 line-through">
              ₹{{ number_format($medicine->original_price, 2) }}
            </span>
          @endif
        </div>

        {{-- Add to Cart button --}}
       
        
                               <button type="button" onclick="addToCart('{{ route('cart.add', $medicine->id) }}')" class="mt-auto w-full bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold py-2.5 rounded-xl flex items-center justify-center gap-2 transition-colors" style="background: #0f6e56; color: #fff;">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
    </svg>
    Add to Cart
</button>

      </div>
    </div>
    @endforeach
  </div>
</section>

  
  @include('layouts.footer')
   <meta name="csrf-token" content="{{ csrf_token() }}">

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