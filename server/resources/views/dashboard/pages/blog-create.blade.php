@extends('dashboard.layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-8 pb-40">
    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" id="postForm">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            {{-- Left Column: Main Editor --}}
            <div class="lg:col-span-8 space-y-6">
                <div class="bg-white/70 backdrop-blur-xl border border-white rounded-[3rem] p-8 sm:p-12 shadow-2xl shadow-slate-200/50">
                    <div class="mb-8">
                        <h2 class="text-3xl font-800 tracking-tight text-slate-900">New Post</h2>
                        <p class="text-slate-500 text-sm font-medium">Structure your thoughts and publish to the world.</p>
                    </div>

                    <div class="space-y-8">
                        {{-- Title Input --}}
                        <div class="relative group">
                            <input type="text" name="title" id="title" required
                                class="peer w-full bg-transparent border-b-2 border-slate-100 py-4 text-2xl font-800 outline-none focus:border-indigo-500 transition-all placeholder:text-slate-300" 
                                placeholder="Post Title">
                            <label for="title" class="absolute left-0 -top-4 text-[10px] font-800 text-indigo-500 uppercase tracking-widest opacity-0 peer-placeholder-shown:opacity-0 peer-focus:opacity-100 transition-all">Headline</label>
                        </div>

                        {{-- Content Editor --}}
                        <div class="space-y-3">
                            <label for="content" class="text-[10px] font-800 text-slate-400 uppercase tracking-widest ml-1">Article Body</label>
                            <textarea name="content" id="content" rows="12" required
                                class="w-full bg-slate-50/50 border border-slate-100 rounded-[2rem] p-8 outline-none focus:bg-white focus:ring-4 focus:ring-indigo-500/5 transition-all text-slate-700 leading-relaxed resize-none" 
                                placeholder="Start writing your story here..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Settings & Sidebar --}}
            <div class="lg:col-span-4 space-y-6">
                
                {{-- 1. Featured Image Card --}}
                <div class="bg-indigo-600 rounded-[2.5rem] p-8 text-white shadow-xl shadow-indigo-200">
                    <h3 class="text-xs font-800 uppercase tracking-widest mb-6 opacity-80">Featured Image</h3>
                    
                    <div class="relative group border-2 border-dashed border-white/30 rounded-[2rem] p-2 transition-all hover:border-white/60 hover:bg-white/5 min-h-[200px] flex items-center justify-center overflow-hidden">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30">
                        
                        <div id="placeholderContent" class="text-center p-6">
                            <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </div>
                            <p class="text-sm font-bold">Upload Photo</p>
                        </div>

                        <div id="imagePreviewContainer" class="hidden absolute inset-0 w-full h-full z-20">
                            <img id="imagePreview" src="#" alt="Preview" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-indigo-900/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity backdrop-blur-sm">
                                <p class="text-xs font-bold uppercase tracking-widest">Change Image</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. Hash Tag Card --}}
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-lg">
                    <h3 class="text-xs font-800 text-slate-400 uppercase tracking-widest mb-6">Taxonomy</h3>
                    
                    <div class="space-y-4">
                        <div class="relative group">
                            <input type="text" id="tagInput" 
                                class="w-full bg-slate-50 border border-slate-100 rounded-2xl p-4 pl-10 outline-none focus:ring-4 focus:ring-indigo-500/5 transition-all text-sm font-semibold" 
                                placeholder="Press Enter to add...">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">#</span>
                        </div>

                        <div id="tagsContainer" class="flex flex-wrap gap-2 min-h-[30px]">
                            <p id="tagPlaceholder" class="text-[10px] text-slate-400 font-medium italic">No tags added yet...</p>
                        </div>

                        <input type="hidden" name="tags" id="hiddenTagsInput">
                    </div>
                </div>

                {{-- 3. Publishing Card --}}
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-lg">
                    <h3 class="text-xs font-800 text-slate-400 uppercase tracking-widest mb-6">Publishing</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl">
                            <div id="statusDot" class="w-2 h-2 bg-slate-300 rounded-full"></div>
                            <span id="statusText" class="text-xs font-bold text-slate-600">status : publish</span>
                        </div>

                        <button type="submit" 
                            class="w-full bg-slate-900 text-white py-5 rounded-[1.5rem] font-800 text-lg hover:bg-indigo-600 hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-slate-200">
                            Push Live
                        </button>
                        
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<style>
    textarea::-webkit-scrollbar { width: 6px; }
    textarea::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    input:focus ~ label { transform: translateY(-4px); }
    
    .tag-badge {
        animation: tagAppear 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes tagAppear {
        from { opacity: 0; transform: scale(0.8); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selectors
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const placeholder = document.getElementById('placeholderContent');
    const previewImage = document.getElementById('imagePreview');
    const tagInput = document.getElementById('tagInput');
    const tagsContainer = document.getElementById('tagsContainer');
    const tagPlaceholder = document.getElementById('tagPlaceholder');
    const hiddenTagsInput = document.getElementById('hiddenTagsInput');
    const statusDot = document.getElementById('statusDot');
    const statusText = document.getElementById('statusText');
    const resetBtn = document.getElementById('resetBtn');

    let tagsArray = [];

    // --- Image Logic ---
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (event) => {
                previewImage.src = event.target.result;
                placeholder.classList.add('hidden');
                previewContainer.classList.remove('hidden');
                updateStatus(true);
            };
            reader.readAsDataURL(file);
        }
    });

    // --- Hashtag Logic ---
    tagInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const val = this.value.trim().replace(/#/g, '');
            if (val && !tagsArray.includes(val)) {
                tagsArray.push(val);
                addTagToUI(val);
                this.value = '';
                tagPlaceholder.classList.add('hidden');
                updateHiddenTags();
            }
        }
    });

    function addTagToUI(label) {
        const div = document.createElement('div');
        div.className = "tag-badge flex items-center gap-2 px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-[11px] font-bold border border-indigo-100";
        div.innerHTML = `<span>#${label}</span><button type="button" class="hover:text-red-500" onclick="removeTag('${label}', this)">×</button>`;
        tagsContainer.appendChild(div);
    }

    window.removeTag = function(label, btn) {
        tagsArray = tagsArray.filter(t => t !== label);
        btn.parentElement.remove();
        if (tagsArray.length === 0) tagPlaceholder.classList.remove('hidden');
        updateHiddenTags();
    };

    function updateHiddenTags() {
        hiddenTagsInput.value = tagsArray.join(',');
    }

    function updateStatus(isReady) {
        if (isReady) {
            statusDot.className = "w-2 h-2 bg-emerald-500 rounded-full animate-pulse";
            statusText.innerText = "Status: Ready to Post";
        } else {
            statusDot.className = "w-2 h-2 bg-slate-300 rounded-full";
            statusText.innerText = "Status: Draft";
        }
    }

    // --- Global Reset ---
    resetBtn.addEventListener('click', () => {
        setTimeout(() => {
            previewContainer.classList.add('hidden');
            placeholder.classList.remove('hidden');
            tagsContainer.querySelectorAll('.tag-badge').forEach(t => t.remove());
            tagPlaceholder.classList.remove('hidden');
            tagsArray = [];
            updateHiddenTags();
            updateStatus(false);
        }, 50);
    });
});
</script>
@endsection