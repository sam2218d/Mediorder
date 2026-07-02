<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicines Product Grid</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white font-sans text-gray-900">

    @include('layouts.navigation')

    <div class="px-4 sm:px-6 lg:px-10 py-6 sm:py-10">

        <div class="flex flex-col md:flex-row gap-6 md:gap-8 items-start max-w-7xl mx-auto">

            <aside class="w-full md:w-[260px] shrink-0">
                @include('layouts.sidebar')
            </aside>

            <main class="flex-1 w-full">
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
                    @foreach($medicines as $medicine)

                    <div class="flex flex-col border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">

                       <div class="relative h-32 sm:h-44 flex items-center justify-center p-3 sm:p-5
                            @if($loop->index % 4 == 0) bg-amber-50
                            @elseif($loop->index % 4 == 1) bg-blue-50
                             @elseif($loop->index % 4 == 2) bg-teal-50
                             @else bg-slate-50 @endif">

                            
                            @if($medicine->image)
                            <img
                                src="{{ asset('storage/' . $medicine->image) }}"
                                alt="{{ $medicine->name }}"
                                class="object-contain w-full h-full group-hover:scale-105 transition-transform duration-300">
                            @endif


                        </div>


                        <div class="p-3 sm:p-5 flex flex-col flex-grow bg-white">
                            @if($medicine->name)
                            <h3 class="text-sm sm:text-lg font-bold text-gray-900 mb-1 sm:mb-2 leading-tight">{{ $medicine->name }}</h3>
                            @endif
                            <p class="text-base sm:text-xl font-black text-gray-900 mb-3 sm:mb-5">₹{{ number_format($medicine->price, 2) }}</p>

                            

                               <button type="button" onclick="addToCart('{{ route('cart.add', $medicine->id) }}')" class="mt-auto w-full bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold py-2 sm:py-2.5 rounded-xl flex items-center justify-center gap-1.5 sm:gap-2 transition-colors text-xs sm:text-sm">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 sm:w-5 sm:h-5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
    </svg>
    Add to Cart
</button>
                           

                        </div>


                    </div>
                    @endforeach

                </div>
            </main>

        </div>
    </div>
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

@include('layouts.footer')


<!-- //chatbot -->


</body>

</html>