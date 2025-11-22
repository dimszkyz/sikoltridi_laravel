<aside 
    x-data="{ 
        collapsed: false, 
        actuatingOpen: false,
        logoutModalOpen: false 
    }"
    :class="collapsed ? 'w-20' : 'w-72'"
    class="group fixed md:static inset-y-0 left-0 z-40 flex h-screen flex-col bg-gradient-to-b from-slate-900 to-slate-800 text-slate-200 shadow-2xl ring-1 ring-slate-700/40 transition-all duration-300"
>
    <div class="flex items-center px-4 py-4 border-b border-white/5" :class="collapsed ? 'justify-end' : 'justify-between'">
        <div x-show="!collapsed" class="flex items-center gap-3 transition-opacity duration-300">
            <div class="h-9 w-9 rounded-xl bg-indigo-500/20 grid place-items-center ring-1 ring-indigo-400/30">
                <span class="font-black text-indigo-300">Si</span>
            </div>
            <div>
                <p class="text-lg font-semibold tracking-wide">Sikoltridi</p>
                <p class="text-xs text-slate-400 -mt-1">Admin Panel</p>
            </div>
        </div>
        <button @click="collapsed = !collapsed" class="text-slate-300/80 hover:text-white rounded-lg p-2 transition" :title="collapsed ? 'Expand' : 'Collapse'">
            <svg x-show="collapsed" class="w-4 h-4" fill="currentColor" viewBox="0 0 448 512"><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
            <svg x-show="!collapsed" class="w-4 h-4" fill="currentColor" viewBox="0 0 320 512"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L67.3 256 246.6 76.7c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
        <a href="{{ url('/') }}" target="_blank" class="relative flex items-center gap-3 rounded-xl px-3 py-3 transition hover:bg-white/5 hover:shadow-inner text-slate-300">
            <div class="grid place-items-center h-9 w-9 rounded-lg transition bg-white/5 text-slate-300">
               <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            </div>
            <span x-show="!collapsed" class="text-sm font-medium tracking-wide">Lihat Situs</span>
        </a>

        <a href="{{ route('admin.dashboard') }}" 
           class="relative flex items-center gap-3 rounded-xl px-3 py-3 transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-500/10 text-white ring-1 ring-indigo-400/30' : 'text-slate-300 hover:bg-white/5' }}">
            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-8 w-1 rounded-r-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-400' : 'bg-transparent' }}"></span>
            <div class="grid place-items-center h-9 w-9 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-500/20 text-indigo-300' : 'bg-white/5 text-slate-300' }}">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 512 512"><path d="M64 64c0-17.7-14.3-32-32-32S0 46.3 0 64V400c0 44.2 35.8 80 80 80H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H80c-8.8 0-16-7.2-16-16V64zm406.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L320 210.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0l-112 112c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L240 221.3l57.4 57.4c12.5 12.5 32.8 12.5 45.3 0l128-128z"/></svg>
            </div>
            <span x-show="!collapsed" class="text-sm font-medium tracking-wide">Dashboard</span>
        </a>

        <div class="relative">
            <button @click="actuatingOpen = !actuatingOpen" 
                class="w-full relative flex items-center gap-3 rounded-xl px-3 py-3 transition hover:bg-white/5 text-slate-300 text-left">
                <div class="grid place-items-center h-9 w-9 rounded-lg transition bg-white/5 text-slate-300">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 384 512"><path d="M192 0c-41.8 0-77.4 26.7-90.5 64H64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H282.5C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM112 192H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                </div>
                <div x-show="!collapsed" class="flex items-center justify-between w-full">
                    <span class="text-sm font-medium tracking-wide">Actuating</span>
                    <svg :class="{'rotate-180': actuatingOpen}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </button>
            <div x-show="!collapsed && actuatingOpen" class="mt-1 ml-12 space-y-1" style="display: none;">
                <a href="#" class="block rounded-lg px-3 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition">Video</a>
                <a href="#" class="block rounded-lg px-3 py-2 text-sm text-slate-300 hover:bg-white/5 hover:text-white transition">Foto</a>
            </div>
        </div>
    </nav>

    <div class="mt-auto border-t border-white/5 px-3 py-3">
        <div class="flex items-center gap-3" :class="collapsed ? 'justify-center' : 'justify-between'">
            <div x-show="!collapsed" class="flex items-center gap-3">
                <img src="https://placehold.co/36x36?text=A" alt="Admin" class="h-9 w-9 rounded-full ring-1 ring-white/10">
                <div class="leading-tight">
                    <p class="text-sm font-semibold">{{ Auth::user()->username ?? 'Admin' }}</p>
                    <p class="text-xs text-slate-400 capitalize">{{ Auth::user()->level ?? 'level' }}</p>
                </div>
            </div>
            <button @click="logoutModalOpen = true" class="flex items-center gap-2 rounded-lg px-3 py-2 text-slate-200 hover:bg-red-500/10 hover:text-red-300 transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                <span x-show="!collapsed" class="text-sm font-medium">Logout</span>
            </button>
        </div>
    </div>

    <div x-show="logoutModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm" style="display: none;">
        <div class="relative w-full max-w-md p-6 mx-4 bg-slate-800 rounded-2xl shadow-lg ring-1 ring-white/10" @click.outside="logoutModalOpen = false">
            <button @click="logoutModalOpen = false" class="absolute top-3 right-3 text-slate-400 hover:text-white transition-colors">
                ✕
            </button>
            <div class="flex flex-col items-center text-center">
                <div class="grid w-16 h-16 mb-4 text-yellow-400 bg-yellow-400/10 rounded-full place-items-center ring-8 ring-yellow-400/20">
                    !
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Konfirmasi Logout</h2>
                <p class="text-slate-300 mb-8">Apakah Anda yakin ingin keluar dari Admin Panel?</p>
                <div class="flex justify-center w-full gap-4">
                    <button @click="logoutModalOpen = false" class="w-full px-6 py-3 font-semibold text-white transition bg-slate-600 rounded-lg hover:bg-slate-500">Batal</button>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full px-6 py-3 font-semibold text-white transition bg-red-600 rounded-lg hover:bg-red-500">Ya, Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</aside>