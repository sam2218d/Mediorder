<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicines Sidebar - Tailwind CSS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white p-10 font-sans text-gray-900"> -->

    <aside class="w-[260px] flex flex-col gap-8">
        <h1 class="text-[28px] font-black tracking-tight text-gray-900">All Medicines</h1>

        <div class="flex flex-col gap-3">
            <h2 class="text-lg font-bold text-gray-900 mb-1">Categories</h2>
            
            <label class="flex items-center text-[14.5px] text-gray-700 cursor-pointer hover:text-gray-900">
                <input type="checkbox" name="category" value="antibiotics" 
                    class="appearance-none w-4 h-4 bg-gray-600 rounded-[2px] mr-3 cursor-pointer outline-none shrink-0 hover:bg-gray-700 transition-colors">
                Antibiotics
            </label>
            
            <label class="flex items-center text-[14.5px] text-gray-700 cursor-pointer hover:text-gray-900">
                <input type="checkbox" name="category" value="vitamins" 
                    class="appearance-none w-4 h-4 bg-gray-600 rounded-[2px] mr-3 cursor-pointer outline-none shrink-0 hover:bg-gray-700 transition-colors">
                Vitamins & Supplements
            </label>
            
            <label class="flex items-center text-[14.5px] text-gray-700 cursor-pointer hover:text-gray-900">
                <input type="checkbox" name="category" value="pain-relief" 
                    class="appearance-none w-4 h-4 bg-gray-600 rounded-[2px] mr-3 cursor-pointer outline-none shrink-0 hover:bg-gray-700 transition-colors">
                Pain Relief
            </label>
            
            <label class="flex items-center text-[14.5px] text-gray-700 cursor-pointer hover:text-gray-900">
                <input type="checkbox" name="category" value="first-aid" 
                    class="appearance-none w-4 h-4 bg-gray-600 rounded-[2px] mr-3 cursor-pointer outline-none shrink-0 hover:bg-gray-700 transition-colors">
                First Aid
            </label>
            
            <label class="flex items-center text-[14.5px] text-gray-700 cursor-pointer hover:text-gray-900">
                <input type="checkbox" name="category" value="devices" 
                    class="appearance-none w-4 h-4 bg-gray-600 rounded-[2px] mr-3 cursor-pointer outline-none shrink-0 hover:bg-gray-700 transition-colors">
                Devices
            </label>
        </div>

        

        <div class="flex flex-col gap-3">
            <h2 class="text-lg font-bold text-gray-900 mb-1">Price Range</h2>
            
            <label class="flex items-center text-[14.5px] text-gray-700 cursor-pointer hover:text-gray-900">
                <input type="radio" name="price" value="under-10" 
                    class="appearance-none w-4 h-4 bg-gray-600 rounded-full mr-3 cursor-pointer outline-none shrink-0 flex items-center justify-center hover:bg-gray-700 checked:bg-transparent checked:border-2 checked:border-gray-800 checked:after:content-[''] checked:after:w-2 checked:after:h-2 checked:after:bg-[#8cb4f5] checked:after:rounded-full transition-all">
                Under ₹10
            </label>
            
            <label class="flex items-center text-[14.5px] text-gray-700 cursor-pointer hover:text-gray-900">
                <input type="radio" name="price" value="10-to-25" checked 
                    class="appearance-none w-4 h-4 bg-gray-600 rounded-full mr-3 cursor-pointer outline-none shrink-0 flex items-center justify-center hover:bg-gray-700 checked:bg-transparent checked:border-2 checked:border-gray-800 checked:after:content-[''] checked:after:w-2 checked:after:h-2 checked:after:bg-[#8cb4f5] checked:after:rounded-full transition-all">
                ₹10 - ₹25
            </label>
            
            <label class="flex items-center text-[14.5px] text-gray-700 cursor-pointer hover:text-gray-900">
                <input type="radio" name="price" value="over-25" 
                    class="appearance-none w-4 h-4 bg-gray-600 rounded-full mr-3 cursor-pointer outline-none shrink-0 flex items-center justify-center hover:bg-gray-700 checked:bg-transparent checked:border-2 checked:border-gray-800 checked:after:content-[''] checked:after:w-2 checked:after:h-2 checked:after:bg-[#8cb4f5] checked:after:rounded-full transition-all">
                Over ₹25
            </label>
        </div>
    </aside>

<!-- </body>
</html> -->