<nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-20">
      
      <a href="/" class="flex items-center gap-3 shrink-0">
        <div class="bg-emerald-800 text-white rounded-lg w-10 h-10 flex items-center justify-center font-extrabold text-xl">
          M
        </div>
        <span class="text-2xl font-bold text-gray-900 tracking-tight">MediOrder</span>
      </a>

      <div class="hidden md:flex items-center gap-8">
        <a href="{{ route('medicines.index') }}" class="text-gray-600 font-medium hover:text-emerald-700 transition-colors">Medicines</a>
        <a href="#" class="text-gray-600 font-medium hover:text-emerald-700 transition-colors">Wellness</a>
        <a href="#" class="text-gray-600 font-medium hover:text-emerald-700 transition-colors">Lab Tests</a>
        <a href="{{ route('myorders.index') }}" class="text-gray-900 font-semibold hover:text-emerald-700 transition-colors">My Orders</a>
      </div>

      <div class="flex items-center gap-6">
        
        <a href="/cart" class="relative text-gray-800 hover:text-emerald-700 transition-colors" aria-label="Cart">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
          </svg>
          <span id="cart-count" class="absolute -top-1.5 -right-2 bg-emerald-500 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
            0
          </span>
        </a>

        <div class="hidden sm:block h-8 w-px bg-gray-200"></div>

        @guest
            <a href="/login" class="hidden sm:flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-5 py-2.5 rounded-lg font-medium transition-all shadow-sm">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
              </svg>
              <span>Login / Register</span>
            </a>
        @endguest

        @auth
            <div class="hidden sm:flex items-center gap-4">
                <span class="text-sm font-bold text-gray-700">Hi, {{ Auth::user()->name ?? 'User' }}</span>
                
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg font-medium transition-all shadow-sm border border-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        @endauth
        
        <button class="md:hidden text-gray-800 hover:text-emerald-700">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>

      </div>
    </div>
  </div>
</nav>