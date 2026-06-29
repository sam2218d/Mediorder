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

    <div class="p-10">

        <div class="flex flex-col md:flex-row gap-8 items-start max-w-7xl mx-auto">

            <aside class="w-full md:w-[260px] shrink-0">
                @include('layouts.sidebar')
            </aside>

            <main class="flex-1">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($medicines as $medicine)

                    <div class="flex flex-col border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">

                        <div class="relative bg-gray-50 aspect-square flex items-center justify-center p-6">
                            <div class="absolute top-4 left-4 flex flex-col gap-2 z-10">
                                <span class="inline-flex items-center px-3 py-1 rounded-full border border-emerald-300 bg-white text-[13px] font-bold text-emerald-600 shadow-sm">
                                    In Stock
                                </span>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-gray-800 text-[13px] font-bold text-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                                    </svg>
                                    Rx Required
                                </span>
                            </div>
                            @if($medicine->image)
                            <img
                                src="{{ asset('storage/' . $medicine->image) }}"
                                alt="{{ $medicine->name }}"
                                class="h-3/4 w-full object-cover rounded-lg border">
                            @endif


                        </div>


                        <div class="p-5 flex flex-col flex-grow bg-white">
                            @if($medicine->name)
                            <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight">{{ $medicine->name }}</h3>
                            @endif
                            <p class="text-xl font-black text-gray-900 mb-5">₹{{ number_format($medicine->price, 2) }}</p>

                            

                               <button type="button" onclick="addToCart('{{ route('cart.add', $medicine->id) }}')" class="mt-auto w-full bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold py-2.5 rounded-xl flex items-center justify-center gap-2 transition-colors">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
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
</body>

</html>