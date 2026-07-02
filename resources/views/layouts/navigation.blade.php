<nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16 sm:h-20">
      
      <a href="/" class="flex items-center gap-3 shrink-0">
         <img src="{{ asset('logo.png') }}" alt="MediOrder" class="h-8 sm:h-20 w-auto">
      </a>

      <div class="hidden md:flex items-center gap-8">
        <a href="/" class="text-gray-900 font-semibold hover:text-emerald-700 transition-colors">home</a>
        <a href="{{ route('medicines.index') }}" class="text-gray-600 font-medium hover:text-emerald-700 transition-colors">Medicines</a>
        <a href="{{ route('myorders.index') }}" class="text-gray-900 font-semibold hover:text-emerald-700 transition-colors">My Orders</a>
        
      </div>

      <div class="flex items-center gap-3 sm:gap-5">
        
        <a href="/cart" class="relative text-gray-800 hover:text-emerald-700 transition-colors" aria-label="Cart">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 sm:w-7 sm:h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
          </svg>
          <span id="cart-count" class="absolute -top-1.5 -right-2 bg-emerald-500 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white">
            0
          </span>
        </a>

        <div class="hidden sm:block h-8 w-px bg-gray-200 mx-1"></div>

        @guest
            <a href="/login" class="hidden sm:flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-5 py-2.5 rounded-lg font-medium transition-all shadow-sm">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
              </svg>
              <span>Login / Register</span>
            </a>
        @endguest

        @auth
            <div class="relative group hidden sm:block">
                <button class="flex items-center gap-2.5 p-1 pr-3 bg-white border border-gray-200 rounded-full hover:shadow-sm hover:border-gray-300 transition-all focus:outline-none">
                    <img src="{{ Auth::user()->img ? Storage::url(Auth::user()->img) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'User') . '&background=00a86b&color=fff&bold=true' }}" alt="Profile" class="w-9 h-9 rounded-full object-cover shadow-sm">
                    
                    <div class="flex flex-col text-left">
                        <span class="text-[13px] font-bold text-gray-900 leading-tight">{{ Auth::user()->name ?? 'User' }}</span>
                        <span class="text-[11px] font-medium text-gray-500 leading-tight">Member</span>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-gray-400 ml-1 group-hover:text-gray-600 transition-colors">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div class="absolute right-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right translate-y-2 group-hover:translate-y-0 z-50">
                    <div class="p-2">
                        <a href="{{ route('myorders.index') }}" class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-emerald-600 rounded-lg transition-colors">
                            My Orders
                        </a>
                        
                        <div class="h-px bg-gray-100 my-1"></div>
                        
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endauth
        
        {{-- Mobile hamburger button --}}
        <button id="mobile-menu-btn" onclick="toggleMobileMenu()" class="md:hidden text-gray-800 hover:text-emerald-700 ml-1 p-1">
          <svg id="hamburger-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 hidden">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>

      </div>
    </div>
  </div>

  {{-- ===== MOBILE MENU DRAWER ===== --}}
  <div id="mobile-menu" class="md:hidden hidden border-t border-gray-100 bg-white shadow-lg">
    <div class="px-4 py-4 space-y-1">
      
      {{-- Nav Links --}}
      <a href="{{ route('medicines.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 font-semibold text-[15px] rounded-xl hover:bg-gray-50 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-emerald-600">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
        </svg>
        Medicines
      </a>
      
      <a href="{{ route('myorders.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 font-semibold text-[15px] rounded-xl hover:bg-gray-50 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-emerald-600">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
        </svg>
        My Orders
      </a>

      <div class="h-px bg-gray-100 my-2"></div>

      @guest
        <a href="/login" class="flex items-center justify-center gap-2 mx-2 mt-2 bg-gray-900 hover:bg-gray-800 text-white px-5 py-3 rounded-xl font-bold text-[15px] transition-all shadow-sm">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
          </svg>
          Login / Register
        </a>
      @endguest

      @auth
        <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-xl mx-1">
          <img src="{{ Auth::user()->img ? Storage::url(Auth::user()->img) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'User') . '&background=00a86b&color=fff&bold=true' }}" alt="Profile" class="w-10 h-10 rounded-full object-cover shadow-sm border-2 border-white">
          <div>
            <p class="text-[14px] font-bold text-gray-900">{{ Auth::user()->name ?? 'User' }}</p>
            <p class="text-[12px] text-gray-500">Member</p>
          </div>
        </div>
        
        <form method="POST" action="{{ route('logout') }}" class="m-0 mt-2">
          @csrf
          <button type="submit" class="w-full flex items-center justify-center gap-2 mx-1 bg-red-50 hover:bg-red-100 text-red-600 font-bold py-3 rounded-xl text-[14px] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
            </svg>
            Logout
          </button>
        </form>
      @endauth
    </div>
  </div>
</nav>

<script>
function toggleMobileMenu() {
  const menu = document.getElementById('mobile-menu');
  const hamburger = document.getElementById('hamburger-icon');
  const closeIcon = document.getElementById('close-icon');
  
  menu.classList.toggle('hidden');
  hamburger.classList.toggle('hidden');
  closeIcon.classList.toggle('hidden');
}
</script>