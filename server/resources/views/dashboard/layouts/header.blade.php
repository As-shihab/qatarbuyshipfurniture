<header class="sticky top-0 z-30 px-8 py-8 flex justify-between items-center bg-white/70 backdrop-blur-md lg:bg-transparent">
    <div>
        <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest mb-1">admin panel</p>
        <h2 id="status-text" class="text-3xl lg:text-4xl font-800 tracking-tight text-slate-900">
            Dashboard
        </h2>
    </div>

    <div class="flex items-center gap-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="p-4 bg-red-50 text-red-600 rounded-2xl font-bold text-xs flex items-center gap-2 hover:bg-red-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span class="hidden sm:inline">Logout</span>
            </button>
        </form>
    </div>
</header>
