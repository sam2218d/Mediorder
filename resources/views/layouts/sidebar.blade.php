<aside class="w-[260px] flex flex-col gap-8">
    <h1 class="text-[28px] font-black tracking-tight text-gray-900">All Medicines</h1>

    <form action="{{ route('medicines.index') }}" method="GET">
        
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
        
    </form> </aside>