<aside class="fixed left-0 top-0 h-screen w-72 glass-sidebar hidden lg:flex flex-col z-40 p-8">
    <div class="mb-12">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg"></div>
            <h1 class="text-2xl font-800 tracking-tighter text-slate-800">
              Admin Panel<span class="text-indigo-600">.</span>
            </h1>
        </div>
    </div>

    <nav class="flex-1 space-y-3">

        {{-- Posts --}}
        <a href="{{ route('admin.dashboard') }}" 
           class="nav-link w-full flex items-center gap-3 px-6 py-4 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-100 text-indigo-600' : 'text-slate-500' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            Posts
        </a>

        {{-- Gallery --}}
        <a href="{{ route('admin.gallery.index') }}" 
           class="nav-link w-full flex items-center gap-3 px-6 py-4 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.gallery.*') ? 'bg-indigo-100 text-indigo-600' : 'text-slate-500' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Gallery
        </a>


             <a href="{{ route('admin.sliders.index') }}" 
           class="nav-link w-full flex items-center gap-3 px-6 py-4 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.sliders.*') ? 'bg-indigo-100 text-indigo-600' : 'text-slate-500' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Sliders
        </a>

        {{-- Services --}}
        <a href="{{ route('admin.services.index') }}" 
           class="nav-link w-full flex items-center gap-3 px-6 py-4 rounded-2xl font-bold transition-all {{ request()->routeIs('admin.services.*') ? 'bg-indigo-100 text-indigo-600' : 'text-slate-500' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Services
        </a>


        <a href="{{ route('admin.contact-messages.index') }}"
   class="nav-link w-full flex items-center gap-3 px-6 py-4 rounded-2xl font-bold transition-all
   {{ request()->routeIs('admin.contact-messages.index') ? 'bg-indigo-100 text-indigo-600' : 'text-slate-500' }}">

    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-width="2"
              d="M21 8a2 2 0 01-2 2H5l-4 4V6a2 2 0 012-2h16a2 2 0 012 2z"/>
    </svg>

    Contact
</a>

        <div class="h-px bg-slate-200 my-4"></div>

        {{-- Security --}}
        <button onclick="openModal('password-modal')" 
            class="w-full flex items-center gap-3 px-6 py-4 rounded-2xl font-bold text-slate-500 hover:bg-white transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
            </svg>
            Security
        </button>
    </nav>

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="mt-auto group relative">
            <div class="p-4 bg-indigo-50/50 rounded-3xl border border-indigo-100 flex items-center gap-3 transition-all">
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ auth()->user()->name }}" class="w-10 h-10 rounded-xl bg-white">
                <div class="flex-1">
                    <p class="text-xs font-bold text-slate-800">{{ auth()->user()->name }}</p>
                    <button type="submit" class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest hover:underline">Sign Out</button>
                </div>
            </div>
        </div>
    </form>
</aside>
