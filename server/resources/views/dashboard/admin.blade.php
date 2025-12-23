
@extends('dashboard.layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-8 pb-40">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-12">
        <div>
            <h2 class="text-4xl font-800 tracking-tight text-slate-900">Your <span class="text-indigo-600">Stories.</span></h2>
            <p class="text-slate-500 font-medium mt-1">Manage, refine, and curate your published content.</p>
        </div>
        <a href="{{route('dashboard.create-blog')  }}" class="inline-flex items-center justify-center gap-2 bg-slate-900 text-white px-8 py-4 rounded-2xl font-800 hover:bg-indigo-600 hover:scale-105 active:scale-95 transition-all shadow-xl shadow-slate-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M12 4v16m8-8H4"/></svg>
            Write New
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($blogs as $blog)
        <div class="group relative bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
            
            <div class="relative h-64 overflow-hidden">
                <img src="{{ asset('blog/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-60"></div>
                
                <div class="absolute top-5 left-5">
                    <span class="px-4 py-2 bg-white/20 backdrop-blur-md border border-white/30 text-white text-[10px] font-800 rounded-xl uppercase tracking-widest">
                        Published
                    </span>
                </div>
            </div>

            <div class="p-8">
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-[10px] font-800 text-indigo-500 uppercase tracking-tighter">{{ $blog->created_at->format('M d, Y') }}</span>
                    <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                    <span class="text-[10px] font-800 text-slate-400 uppercase tracking-tighter">5 min read</span>
                </div>
                
                <h3 class="text-xl font-800 text-slate-900 leading-tight mb-4 group-hover:text-indigo-600 transition-colors line-clamp-2">
                    {{ $blog->title }}
                </h3>
                
                <p class="text-slate-500 text-sm leading-relaxed mb-8 line-clamp-2">
                    {{ Str::limit($blog->content, 100) }}
                </p>

                <div class="flex items-center gap-3 pt-6 border-t border-slate-50">
                    <a href="{{ route('dashboard.edit-blog', $blog->id) }}" class="flex-1 flex items-center justify-center gap-2 bg-indigo-50 text-indigo-600 py-3 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>

                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Permanently delete this story?');" class="flex-shrink-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-12 h-12 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    /* Premium Hover Effect */
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection