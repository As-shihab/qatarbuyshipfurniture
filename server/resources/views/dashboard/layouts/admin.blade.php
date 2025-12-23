<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f1f5f9; overflow-x: hidden; scroll-behavior: smooth; }
        
        .view-section { display: none; animation: slideIn 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
        .view-section.active { display: block; }
        @keyframes slideIn { 
            from { opacity: 0; transform: translateY(30px) scale(0.98); } 
            to { opacity: 1; transform: translateY(0) scale(1); } 
        }

        .glass-sidebar { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(20px); border-right: 1px solid rgba(226, 232, 240, 0.8); }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card:hover { transform: translateY(-8px); background: #ffffff; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08); }

        .nav-link.active { 
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); 
            color: white !important; 
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4); 
        }

        /* Mobile specific style for labels */
        .mobile-nav-btn.active span { color: #4f46e5; font-weight: 800; }
        .mobile-nav-btn.active svg { color: #4f46e5; transform: scale(1.1); }

        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; }
        .toast { animation: toastIn 0.3s ease forwards; }
        @keyframes toastIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
    </style>
</head>
<body class="text-slate-900">

    <div id="toast-container"></div>

    @include('dashboard.layouts.sidebar')


    <main class="lg:ml-72 min-h-screen">
    
        {{-- header --}}

        @include('dashboard.layouts.header')

        {{-- content --}}


{{-- Success Toast Trigger --}}
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toastContainer = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'toast bg-green-500 text-white px-4 py-2 rounded shadow-lg mb-2';
            toast.innerText = "{{ session('success') }}";
            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        });
    </script>
@endif
      
        @yield('content')
  



    </main>

{{-- mobile nav --}}

<nav class="fixed bottom-0 left-0 right-0 lg:hidden bg-white/90 backdrop-blur-2xl border-t border-slate-200 px-1 py-3 flex justify-around items-center z-50">

    {{-- Sliders --}}
    <a href="{{ route('admin.sliders.index') }}"
       class="mobile-nav-btn flex flex-col items-center gap-1 p-1 min-w-[50px] rounded-2xl transition-all
       {{ request()->routeIs('admin.sliders.*') ? 'text-indigo-600 font-extrabold' : 'text-slate-400' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
        </svg>
        <span class="text-[9px] font-bold">Sliders</span>
    </a>

    {{-- Gallery --}}
    <a href="{{ route('admin.gallery.index') }}"
       class="mobile-nav-btn flex flex-col items-center gap-1 p-1 min-w-[50px] rounded-2xl transition-all
       {{ request()->routeIs('admin.gallery.*') ? 'text-indigo-600 font-extrabold' : 'text-slate-400' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span class="text-[9px] font-bold">Gallery</span>
    </a>

    {{-- Blogs (Formerly Services) --}}
    <a href="{{ route('admin.dashboard') }}"
       class="mobile-nav-btn flex flex-col items-center gap-1 p-1 min-w-[50px] rounded-2xl transition-all
       {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600 font-extrabold' : 'text-slate-400' }}">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
        </svg>
        <span class="text-[9px] font-bold">Blogs</span>
    </a>

    {{-- Inbox --}}
    <a href="{{ route('admin.contact-messages.index') }}"
       class="mobile-nav-btn flex flex-col items-center gap-1 p-1 min-w-[50px] rounded-2xl transition-all
       {{ request()->routeIs('admin.contact-messages.*') ? 'text-indigo-600 font-extrabold' : 'text-slate-400' }}">
        <div class="relative">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
            <span class="absolute -top-1 -right-1 flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
            </span>
        </div>
        <span class="text-[9px] font-bold">Inbox</span>
    </a>

    {{-- Security --}}
    <button onclick="openModal('password-modal')"
        class="flex flex-col items-center gap-1 p-1 min-w-[50px] text-slate-400 hover:text-indigo-600 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
        </svg>
        <span class="text-[9px] font-bold">Secure</span>
    </button>
</nav>

</body>
</html>