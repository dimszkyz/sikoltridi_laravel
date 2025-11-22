<header 
    x-data="{ open: false, showDropdown: false, scrolled: false }"
    @scroll.window="scrolled = (window.pageYOffset > 20)"
    class="w-full fixed top-0 left-0 z-50 flex justify-center py-3 transition-all duration-300"
>
    <nav class="w-[92%] max-w-7xl bg-white/90 backdrop-blur-md rounded-full shadow-lg px-5 md:px-8 py-2.5 flex items-center justify-between">
        
        <a href="{{ url('/#home') }}" class="text-[22px] md:text-2xl font-semibold text-slate-800 select-none cursor-pointer">
            Sikoltridi
        </a>

        <ul class="hidden md:flex items-center gap-8 text-slate-700">
            <li><a href="{{ url('/#home') }}" class="font-medium transition hover:text-blue-600 cursor-pointer">Home</a></li>
            <li><a href="{{ url('/#partfile') }}" class="font-medium transition hover:text-blue-600 cursor-pointer">File</a></li>
            <li><a href="{{ url('/#PartPlanning') }}" class="font-medium transition hover:text-blue-600 cursor-pointer">Planning</a></li>
            <li><a href="{{ url('/#PartOrganizing') }}" class="font-medium transition hover:text-blue-600 cursor-pointer">Organizing</a></li>
            <li><a href="{{ url('/#PartMedia') }}" class="font-medium transition hover:text-blue-600 cursor-pointer">Actuating</a></li>
            <li><a href="{{ url('/controlling') }}" class="font-medium transition hover:text-blue-600 cursor-pointer">Controlling</a></li>
        </ul>

        <div class="hidden md:flex items-center relative">
            @auth
                <div class="relative" @click.outside="showDropdown = false">
                    <button @click="showDropdown = !showDropdown" class="flex items-center bg-blue-50 px-4 py-1.5 rounded-full hover:bg-blue-100 transition shadow-sm">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="user" class="w-6 h-6 mr-2"/>
                        <span class="text-sm font-medium text-slate-800 capitalize">
                            {{ Auth::user()->username }} ({{ Auth::user()->level }})
                        </span>
                    </button>

                    <div x-show="showDropdown" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="absolute right-0 mt-2 w-44 bg-blue-50 text-slate-700 rounded-xl shadow-lg py-2" 
                         style="display: none;">
                        
                        @if(in_array(Auth::user()->level, ['admin', 'superadmin']))
                            <a href="{{ route('admin.dashboard') }}" class="block w-full text-left px-4 py-2 text-sm font-medium text-blue-700 hover:bg-blue-100 rounded-md transition">
                                🛠️ Admin Panel
                            </a>
                            <hr class="my-1 border-blue-100" />
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-blue-100 hover:text-red-600 rounded-md transition">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}">
                    <button class="px-5 py-2 rounded-full bg-blue-500 text-white text-sm font-semibold hover:bg-blue-600 transition shadow">
                        Login
                    </button>
                </a>
            @endauth
        </div>

        <button @click="open = !open" class="md:hidden inline-flex items-center justify-center w-9 h-9 rounded-full hover:bg-slate-100 transition">
            <svg viewBox="0 0 24 24" class="w-6 h-6 text-slate-800" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <path d="M4 7h16" /><path d="M4 12h16" /><path d="M4 17h16" />
            </svg>
        </button>
    </nav>

    <div x-show="open" 
         x-transition 
         class="md:hidden fixed left-1/2 -translate-x-1/2 top-[76px] w-[92%] max-w-7xl z-40"
         style="display: none;">
        <div class="bg-white/95 backdrop-blur-md shadow-lg rounded-2xl p-3 flex flex-col gap-2">
            <a href="{{ url('/#home') }}" class="block px-3 py-2 rounded-xl font-medium text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition">Home</a>
            <a href="{{ url('/#partfile') }}" class="block px-3 py-2 rounded-xl font-medium text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition">File</a>
            <a href="{{ url('/controlling') }}" class="block px-3 py-2 rounded-xl font-medium text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition">Controlling</a>
            
            <hr class="my-2 border-slate-200" />
            
            @auth
                @if(in_array(Auth::user()->level, ['admin', 'superadmin']))
                    <a href="{{ route('admin.dashboard') }}" class="block w-full text-left px-3 py-2 rounded-xl text-blue-700 font-medium hover:bg-blue-50 transition">
                        🛠️ Admin Panel
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="block w-full text-left px-3 py-2 rounded-xl text-red-500 font-medium hover:bg-red-50 transition">
                        Logout ({{ Auth::user()->username }})
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block w-full text-left px-3 py-2 rounded-xl font-medium text-blue-600 hover:bg-blue-50 transition">
                    Login
                </a>
            @endauth
        </div>
    </div>
</header>