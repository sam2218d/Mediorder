<aside class="w-full md:w-[260px] flex flex-col gap-6 md:gap-8">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl md:text-[28px] font-black tracking-tight text-gray-900">All Medicines</h1>
        {{-- Mobile filter toggle --}}
        <button id="filter-toggle" onclick="toggleFilters()" class="md:hidden flex items-center gap-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-sm font-semibold transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
            </svg>
            Filters
        </button>
    </div>

    <form action="{{ route('medicines.index') }}" method="GET" id="filter-form" class="hidden md:block">
        
        @foreach(request()->except('categories', 'price') as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        <div class="flex flex-col gap-3 mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-1">Categories</h2>
            
            @foreach($categories as $category)
                <label class="flex items-center text-[14.5px] text-gray-700 cursor-pointer hover:text-gray-900">
                    <input 
                        type="checkbox" 
                        name="categories[]" 
                        value="{{ $category->id }}" 
                        @if(is_array(request('categories')) && in_array($category->id, request('categories'))) checked @endif
                        onchange="this.form.submit();"
                        class="appearance-none w-4 h-4 bg-gray-600 rounded-[2px] mr-3 cursor-pointer outline-none shrink-0 hover:bg-gray-700 transition-colors"
                    >
                    {{ $category->name }}
                </label>
            @endforeach
        </div>

        <div class="flex flex-col gap-3">
            <h2 class="text-lg font-bold text-gray-900 mb-1">Price Range</h2>
            
            <label class="flex items-center text-[14.5px] text-gray-700 cursor-pointer hover:text-gray-900">
                <input 
                    type="radio" 
                    name="price" 
                    value="under-10" 
                    @if(request('price') == 'under-10') checked @endif
                    onchange="this.form.submit();"
                    class="appearance-none w-4 h-4 bg-gray-600 rounded-full mr-3 cursor-pointer outline-none shrink-0 flex items-center justify-center hover:bg-gray-700 checked:bg-transparent checked:border-2 checked:border-gray-800 checked:after:content-[''] checked:after:w-2 checked:after:h-2 checked:after:bg-[#8cb4f5] checked:after:rounded-full transition-all"
                >
                Under ₹10
            </label>
            
            <label class="flex items-center text-[14.5px] text-gray-700 cursor-pointer hover:text-gray-900">
                <input 
                    type="radio" 
                    name="price" 
                    value="10-to-25" 
                    @if(request('price') == '10-to-25') checked @endif
                    onchange="this.form.submit();"
                    class="appearance-none w-4 h-4 bg-gray-600 rounded-full mr-3 cursor-pointer outline-none shrink-0 flex items-center justify-center hover:bg-gray-700 checked:bg-transparent checked:border-2 checked:border-gray-800 checked:after:content-[''] checked:after:w-2 checked:after:h-2 checked:after:bg-[#8cb4f5] checked:after:rounded-full transition-all"
                >
                ₹10 - ₹25
            </label>
            
            <label class="flex items-center text-[14.5px] text-gray-700 cursor-pointer hover:text-gray-900">
                <input 
                    type="radio" 
                    name="price" 
                    value="over-25" 
                    @if(request('price') == 'over-25') checked @endif
                    onchange="this.form.submit();"
                    class="appearance-none w-4 h-4 bg-gray-600 rounded-full mr-3 cursor-pointer outline-none shrink-0 flex items-center justify-center hover:bg-gray-700 checked:bg-transparent checked:border-2 checked:border-gray-800 checked:after:content-[''] checked:after:w-2 checked:after:h-2 checked:after:bg-[#8cb4f5] checked:after:rounded-full transition-all"
                >
                Over ₹25
            </label>
        </div>
        
    </form>
</aside>

<script>
function toggleFilters() {
    const form = document.getElementById('filter-form');
    form.classList.toggle('hidden');
    form.classList.toggle('block');
}
</script>