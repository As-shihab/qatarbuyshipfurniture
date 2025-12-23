@extends('dashboard.layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-8 pb-40">
    <div class="mb-10 flex justify-between items-end">
        <div>
            <h2 class="text-4xl font-800 tracking-tight text-slate-900">Inbox<span class="text-indigo-600">.</span></h2>
            <p class="text-slate-500 font-medium mt-1">Manage inquiries from your public contact form.</p>
        </div>
        <div class="bg-white border border-slate-100 px-6 py-3 rounded-3xl shadow-sm">
            <span class="text-2xl font-800 text-slate-900">{{ $messages->count() }}</span>
            <span class="text-[10px] font-800 text-slate-400 uppercase tracking-widest ml-1">Messages</span>
        </div>
    </div>

    <div class="space-y-6">
        @forelse($messages as $msg)
            <div class="group bg-white/70 backdrop-blur-xl border border-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                <div class="flex flex-col lg:flex-row gap-8">
                    
                    <div class="lg:w-1/3 space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-200">
                                {{ strtoupper(substr($msg->fullname, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="text-lg font-800 text-slate-900 leading-tight">{{ $msg->fullname }}</h4>
                                <p class="text-[10px] font-800 text-indigo-500 uppercase tracking-tighter">{{ $msg->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <div class="space-y-2 pt-2">
                            <div class="flex items-center gap-3 text-sm text-slate-500 bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span class="font-600 truncate">{{ $msg->email }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-slate-500 bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span class="font-600">{{ $msg->phone ?? 'No Phone' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-2/3 flex flex-col">
                        <div class="mb-4">
                            <span class="text-[10px] font-800 text-slate-400 uppercase tracking-widest block mb-1">Subject</span>
                            <h3 class="text-xl font-800 text-slate-900">{{ $msg->subject }}</h3>
                        </div>
                        
                        <div class="flex-grow p-6 bg-slate-50/50 rounded-3xl border border-slate-100 text-slate-600 leading-relaxed italic">
                            "{{ $msg->message }}"
                        </div>

                        <div class="flex justify-end mt-6 gap-3">
                            <a href="mailto:{{ $msg->email }}" class="px-6 py-3 bg-indigo-50 text-indigo-600 rounded-2xl font-800 text-xs hover:bg-indigo-600 hover:text-white transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                                Reply via Email
                            </a>
                            
<form action="{{ route('admin.contact-messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Archive this message permanently?')">
    @csrf
    @method('DELETE')
    
    <button type="submit" 
            class="p-3 text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-2xl transition-all group-hover:scale-110">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
    </button>
</form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-32 bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                </div>
                <h3 class="text-slate-900 font-800 text-lg">Your inbox is empty</h3>
                <p class="text-slate-400 text-sm">New contact form submissions will appear here.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection