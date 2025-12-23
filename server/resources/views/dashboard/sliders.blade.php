@extends('dashboard.layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-8 pb-20">
    
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mt-12 mb-10 gap-6">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="text-[10px] font-900 text-slate-400 uppercase tracking-[0.2em]">Hero Section</span>
            </div>
            <h2 class="text-4xl font-900 tracking-tight text-slate-900">Sliders</h2>
            <p class="text-slate-500 text-sm font-medium mt-1">Design the first impression of your website.</p>
        </div>

        <div class="flex items-center gap-4">
            <button onclick="toggleModal(true)" class="bg-slate-900 text-white px-6 py-4 rounded-2xl font-800 text-sm hover:bg-indigo-600 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                New Slide
            </button>
        </div>
    </div>

    {{-- Slider Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @forelse($sliders as $slider)
            <div class="slider-card group relative bg-white border border-slate-100 rounded-[3rem] overflow-hidden shadow-xl shadow-slate-200/50 transition-all duration-500 hover:-translate-y-2">
                
                {{-- Preview Image --}}
                <div class="h-64 overflow-hidden relative">
                    <img src="{{ asset('storage/' . $slider->image) }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                    
                    {{-- Badge --}}
                    <div class="absolute top-6 left-6 flex gap-2">
                        <span class="px-4 py-2 bg-white/90 backdrop-blur text-[10px] font-900 uppercase rounded-xl shadow-sm tracking-wider">
                            Order: {{ $slider->order }}
                        </span>
                    </div>

                    {{-- Floating Actions --}}
                    <div class="absolute top-6 right-6 flex flex-col gap-2 translate-x-12 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300">
                        <button onclick="confirmDelete('{{ $slider->id }}')" class="w-10 h-10 bg-red-500 text-white rounded-full flex items-center justify-center hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-8">
                    <h4 class="text-xl font-900 text-slate-800 mb-2 line-clamp-1">{!! $slider->title !!}</h4>
                    <p class="text-slate-500 text-sm font-medium line-clamp-2 leading-relaxed mb-6">{{ $slider->description }}</p>
                    
                    <div class="flex items-center justify-between border-t border-slate-50 pt-6">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full {{ $slider->is_active ? 'bg-emerald-500' : 'bg-slate-300' }}"></div>
                            <span class="text-[10px] font-800 uppercase text-slate-400 tracking-widest">
                                {{ $slider->is_active ? 'Visible' : 'Hidden' }}
                            </span>
                        </div>
                        <a href="{{ $slider->link }}" target="_blank" class="text-indigo-600 text-[10px] font-900 uppercase tracking-widest hover:text-slate-900 transition-colors">View Link →</a>
                    </div>
                </div>

                <form id="delete-form-{{ $slider->id }}" action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" class="hidden">
                    @csrf @method('DELETE')
                </form>
            </div>
        @empty
            <div class="col-span-full py-24 text-center bg-slate-50 rounded-[4rem] border-2 border-dashed border-slate-200">
                <p class="text-slate-400 font-800 italic text-lg">No slides created yet. Start by adding one.</p>
            </div>
        @endforelse
    </div>
</div>

{{-- ENHANCED MODAL --}}
<div id="createModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-xl" onclick="toggleModal(false)"></div>
    <div class="relative bg-white w-full max-w-2xl rounded-[3.5rem] p-8 sm:p-12 shadow-2xl transition-all transform scale-95 opacity-0 duration-300" id="modalCard">
        
        <div class="flex justify-between items-center mb-10">
            <h3 class="text-3xl font-900 text-slate-900 tracking-tight">Create Slide</h3>
            <button onclick="toggleModal(false)" class="text-slate-400 hover:text-slate-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-6">
            @csrf
            
            <div class="col-span-2">
                <label class="block text-[10px] font-900 uppercase tracking-widest text-slate-400 mb-3 ml-2">Main Heading (HTML allowed)</label>
                <input type="text" name="title" required placeholder=" Sell your Furniture" class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500/20 rounded-2xl py-4 px-6 text-sm font-bold transition-all outline-none">
            </div>

            <div class="col-span-2">
                <label class="block text-[10px] font-900 uppercase tracking-widest text-slate-400 mb-3 ml-2">Sub-Description</label>
                <textarea name="description" rows="3" required class="w-full bg-slate-50 border-2 border-transparent focus:border-indigo-500/20 rounded-2xl py-4 px-6 text-sm font-medium transition-all outline-none"></textarea>
            </div>

            <div class="col-span-2 sm:col-span-1">
                <label class="block text-[10px] font-900 uppercase tracking-widest text-slate-400 mb-3 ml-2">Button Link</label>
                <input type="text" name="link" placeholder="https://..." class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-sm font-bold">
            </div>

            <div class="col-span-2 sm:col-span-1">
                <label class="block text-[10px] font-900 uppercase tracking-widest text-slate-400 mb-3 ml-2">Display Order</label>
                <input type="number" name="order" value="0" class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-sm font-bold">
            </div>

            <div class="col-span-2">
                <label class="block text-[10px] font-900 uppercase tracking-widest text-slate-400 mb-3 ml-2">Hero Image</label>
                <div class="group relative w-full h-32 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex items-center justify-center transition-colors hover:border-indigo-400">
                    <input type="file" name="image" required class="absolute inset-0 opacity-0 cursor-pointer">
                    <div class="text-slate-400 font-bold text-xs flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Click to upload high-res image
                    </div>
                </div>
            </div>

            <button type="submit" class="col-span-2 bg-indigo-600 text-white py-5 rounded-2xl font-900 text-sm hover:bg-slate-900 hover:shadow-xl transition-all duration-300 mt-4">
                Publish Slide
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function toggleModal(show) {
        const modal = document.getElementById('createModal');
        const card = document.getElementById('modalCard');
        if (show) {
            modal.classList.remove('hidden'); modal.classList.add('flex');
            setTimeout(() => { card.classList.remove('scale-95', 'opacity-0'); card.classList.add('scale-100', 'opacity-100'); }, 10);
        } else {
            card.classList.remove('scale-100', 'opacity-100'); card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
        }
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Delete Slide?',
            text: "This will remove it from your homepage hero section.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#f1f5f9',
            confirmButtonText: 'Yes, Delete',
            customClass: { popup: 'rounded-[3rem]', confirmButton: 'rounded-2xl font-800 py-3 px-6', cancelButton: 'rounded-2xl font-800 py-3 px-6 text-slate-600' }
        }).then((result) => {
            if (result.isConfirmed) { document.getElementById('delete-form-' + id).submit(); }
        });
    }
</script>

<style>
    .slider-card { animation: slideIn 0.6s cubic-bezier(0.23, 1, 0.32, 1) forwards; }
    @keyframes slideIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection