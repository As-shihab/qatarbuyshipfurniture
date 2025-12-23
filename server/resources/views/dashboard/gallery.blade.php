@extends('dashboard.layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-8 pb-20">
    
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mt-12 mb-10 gap-6">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                </span>
                <span class="text-[10px] font-900 text-slate-400 uppercase tracking-[0.2em]">Media Vault</span>
            </div>
            <h2 class="text-4xl font-900 tracking-tight text-slate-900">Gallery</h2>
            <p class="text-slate-500 text-sm font-medium mt-1">Manage your visual assets.</p>
        </div>

        <div class="flex items-center gap-4">
            <button onclick="toggleModal(true)" class="bg-indigo-600 text-white px-6 py-4 rounded-2xl font-800 text-sm hover:bg-slate-900 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                Upload Media
            </button>

            <div class="hidden sm:flex bg-white border border-white shadow-xl shadow-slate-200/50 px-6 py-3 rounded-2xl items-center gap-4">
                <p id="assetCount" class="text-lg font-900 text-slate-900 leading-none">{{ $galleries->count() }} Assets</p>
            </div>
        </div>
    </div>

    {{-- Gallery List --}}
    <div class="bg-white/70 backdrop-blur-2xl border border-white rounded-[4rem] p-6 sm:p-10 shadow-2xl shadow-slate-200/40">
        <div id="galleryList" class="grid grid-cols-1 gap-4">
            @forelse($galleries as $item)
                <div class="gallery-card group flex flex-col md:flex-row items-center gap-8 bg-white/40 border border-slate-50 hover:border-indigo-100 hover:bg-white p-5 rounded-[2.5rem] transition-all duration-500 hover:shadow-xl shadow-slate-200/50">
                    
                    {{-- Image --}}
                    <div class="w-full md:w-36 h-36 rounded-[2rem] overflow-hidden shadow-sm flex-shrink-0 relative">
                        <img src="{{ asset('galaray/' . $item->file_name) }}" class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110">
                        {{-- Status Badge --}}
                        <span class="absolute top-3 right-3 px-2 py-1 bg-white/90 backdrop-blur text-[8px] font-900 uppercase rounded-lg shadow-sm">{{ $item->status }}</span>
                    </div>

                    {{-- Content --}}
                    <div class="flex-grow space-y-2 text-center md:text-left">
                        <h4 class="text-xl font-800 text-slate-800 tracking-tight">{{ $item->title }}</h4>
                        <p class="text-sm text-slate-500 leading-relaxed line-clamp-2 font-medium">{{ $item->description }}</p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-row md:flex-col gap-3">
                        <a href="{{ asset('storage/' . $item->file_name) }}" target="_blank" class="w-12 h-12 bg-white text-slate-400 rounded-xl flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </a>

                        {{-- Trigger simple warning before form submit --}}
                        <button type="button" onclick="confirmDelete('{{ $item->id }}')" class="w-12 h-12 bg-white text-slate-400 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>

                        {{-- Hidden Delete Form --}}
                        <form id="delete-form-{{ $item->id }}" action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            @empty
                <div class="py-20 text-center text-slate-400 font-medium italic">Gallery is empty.</div>
            @endforelse
        </div>
    </div>
</div>

{{-- MODAL --}}
<div id="createModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-md" onclick="toggleModal(false)"></div>
    <div class="relative bg-white w-full max-w-lg rounded-[3rem] p-8 sm:p-12 shadow-2xl transition-all transform scale-95 opacity-0 duration-300" id="modalCard">
        <h3 class="text-2xl font-900 text-slate-900 mb-6">Upload Media</h3>

        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <input type="hidden" name="status" value="active">
            <input type="hidden" name="published_at" value="{{ now() }}">

            <div>
                <label class="block text-[10px] font-900 uppercase tracking-widest text-slate-400 mb-2">Title</label>
                <input type="text" name="title" id="titleInput" required class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10">
                <input type="hidden" name="slug" id="slugInput">
            </div>

            <div>
                <label class="block text-[10px] font-900 uppercase tracking-widest text-slate-400 mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-sm font-medium focus:ring-4 focus:ring-indigo-500/10"></textarea>
            </div>

            <div>
                <label class="block text-[10px] font-900 uppercase tracking-widest text-slate-400 mb-2">Choose File</label>
                <input type="file" name="image" required class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-indigo-50 file:text-indigo-600">
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-800 text-sm hover:bg-slate-900 transition-all duration-300 mt-4">
                Upload
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Success Toast
    @if(session('success'))
        Swal.fire({
            toast: true, position: 'top-end', icon: 'success', title: "{{ session('success') }}",
            showConfirmButton: false, timer: 3000, timerProgressBar: true
        });
    @endif

    // Slug generator
    document.getElementById('titleInput').addEventListener('input', function() {
        document.getElementById('slugInput').value = this.value.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
    });

    // Modal logic
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

    // NEW DELETE LOGIC: Warning then Submit Form
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This file will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1e293b',
            cancelButtonColor: '#f1f5f9',
            confirmButtonText: 'Yes, Delete',
            customClass: {
                popup: 'rounded-[2rem]',
                confirmButton: 'rounded-xl font-800 py-3 px-6',
                cancelButton: 'rounded-xl font-800 py-3 px-6 text-slate-600'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the specific hidden form
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

<style>
    .gallery-card { animation: slideUp 0.5s ease-out forwards; }
    @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection