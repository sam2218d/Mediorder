<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 sm:py-10 min-h-[60vh]">
        
        <div class="mb-6 sm:mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">
                Search Results for "{{ $searchTerm }}"
            </h1>
            <a href="/" class="text-sm font-semibold text-gray-500 hover:text-[#00a86b] transition-colors shrink-0">
                &larr; Back to Home
            </a>
        </div>

        @if($medicines->isEmpty())
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-12 text-center flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-400 mb-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <h3 class="text-lg font-bold text-gray-900 mb-1">No medicines found</h3>
                <p class="text-gray-500 text-sm">We couldn't find anything matching "{{ $searchTerm }}". Check for typos or try a different term.</p>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                @foreach($medicines as $medicine)
            
                    <div class="border border-gray-200 rounded-2xl p-3 sm:p-5 shadow-sm bg-white hover:shadow-md transition-shadow group flex flex-col">

                        
                        <div class="relative h-28 sm:h-44 flex items-center justify-center p-3 sm:p-5 rounded-xl
                            @if($loop->index % 4 == 0) bg-amber-50
                            @elseif($loop->index % 4 == 1) bg-blue-50
                             @elseif($loop->index % 4 == 2) bg-teal-50
                             @else bg-slate-50 @endif">
                        
                        
                             

                            @if($medicine->image)
                                <img src="{{ asset('storage/' . $medicine->image) }}" alt="{{ $medicine->name }}" class="object-contain w-full h-full group-hover:scale-105 transition-transform duration-300">
                            @else
                                <svg class="w-12 h-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @endif
                        </div>

                        <div class="flex-grow">
                            <h3 class="font-bold text-gray-900 text-sm sm:text-base leading-tight mb-1">{{ $medicine->name }}</h3>
                            <p class="text-gray-500 text-[11px] sm:text-xs mb-2 sm:mb-3 line-clamp-2">{{ $medicine->description }}</p>
                        </div>
                        
                        <div class="flex items-center justify-between mt-auto pt-3 sm:pt-4 border-t border-gray-100">
                            <span class="text-base sm:text-lg font-black text-[#00a86b]">₹{{ number_format($medicine->price, 2) }}</span>
                            
                           
                                @csrf
                                <button type="submit" onclick="addToCart('{{ route('cart.add', $medicine->id) }}')" class="bg-gray-900 hover:bg-gray-800 text-white w-8 h-8 rounded-full flex items-center justify-center transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                           
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $medicines->appends(['query' => $searchTerm])->links() }}
            </div>
        @endif

    </div>
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
</x-app-layout>