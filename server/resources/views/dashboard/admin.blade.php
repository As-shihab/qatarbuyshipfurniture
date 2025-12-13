<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ultimate Awesome Mobile Content Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom Styles for Ultimate Awesome Look */
        :root {
            --primary-color: #4f46e5; /* Indigo 600 */
            --secondary-color: #7c3aed; /* Violet 600 */
        }
        body { padding-bottom: 5rem; background-color: #f0f4f8; }
        .view-section { display: none; }
        .view-section.active { display: block; }
        
        /* Modal Backdrop/Transition */
        .dialog-modal {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(8px);
            z-index: 60;
            display: none; 
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        .dialog-modal.open { 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            opacity: 1;
        }
        .dialog-container { 
            width: 100%; max-width: 480px; 
            margin: 1rem; 
            transform: translateY(20px);
            opacity: 0;
            transition: transform 0.4s ease, opacity 0.4s ease;
        }
        .dialog-modal.open .dialog-container {
            transform: translateY(0);
            opacity: 1;
        }

        /* FAB - Floating Action Button (Softer, wider gradient) */
        .main-fab {
            background-image: linear-gradient(to bottom right, #6366f1, #a78bfa); /* Indigo 500 to Violet 400 */
            /* Adjusted shadow for a softer, more lifted look */
            box-shadow: 0 10px 30px -5px rgba(124, 58, 237, 0.7), 0 4px 6px -2px rgba(79, 70, 229, 0.2); 
            transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .main-fab:hover { transform: scale(1.1); }
        
        /* Navigation Button Active State */
        .nav-btn.active {
            color: var(--primary-color) !important;
            border-bottom: 3px solid var(--primary-color);
            transform: translateY(-2px);
            transition: all 0.2s ease;
        }

        /* Awesome Form Input Style */
        .awesome-input {
            border: 1px solid #e2e8f0; 
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            box-shadow: inset 0 1px 3px 0 rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .awesome-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.25);
        }
        
        /* Utility for consistent card image size/style */
        .card-image {
            background-color: #eef2ff; /* Light blue/gray background for placeholder */
            width: 96px; /* w-24 */
            height: 96px; /* h-24 */
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <header class="sticky top-0 z-20 bg-white border-b border-gray-100 shadow-lg p-5 flex justify-center items-center">
        <div id="status-text" class="text-2xl font-black text-gray-900 tracking-wider">Posts</div>
    </header>


<div class="max-w-4xl mx-auto mt-4 space-y-2">

    <!-- Success Message -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-green-100 text-green-800 font-bold text-center shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message (Validation) -->
    @if(session('error'))
        <div class="p-4 rounded-xl bg-red-100 text-red-800 font-bold text-center shadow-md">
            {{ session('error') }}
        </div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="p-4 rounded-xl bg-red-100 text-red-800 font-bold shadow-md">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>


    <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">

   <section id="post-view" class="view-section active space-y-5">
    <h2 class="sr-only">Blog Posts List</h2>

    @forelse($blogs as $blog)
        <div class="bg-white shadow-2xl rounded-2xl p-6
            {{ $blog->status === 'draft' ? 'border-l-4 border-indigo-600' : 'border-l-4 border-green-600' }}
            hover:shadow-3xl transition duration-300 transform hover:scale-[1.01]">

            <div class="flex items-start mb-4">

                <div class="flex-shrink-0 card-image mr-4 rounded-lg overflow-hidden shadow-md">
                    <img
                        src="{{ $blog->image ? asset('storage/blog/'.$blog->image) : 'https://via.placeholder.com/100x100/4f46e5/ffffff?text=Blog' }}"
                        alt="{{ $blog->title }}"
                        class="w-full h-full object-cover">
                </div>

                <div class="flex-grow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-extrabold text-xl text-gray-900 truncate max-w-[150px]">
                                {{ $blog->title }}
                            </h3>
                            <p class="text-sm text-gray-500 truncate max-w-[200px] mt-1">
                                {{ Str::limit($blog->content, 60) }}
                            </p>
                        </div>

                        <span class="text-xs font-extrabold px-3 py-1 rounded-full shadow-md flex-shrink-0
                            {{ $blog->status === 'published'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-indigo-100 text-indigo-700' }}">
                            {{ ucfirst($blog->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                <small class="text-xs text-gray-400">
                    {{ $blog->status === 'published'
                        ? 'Published '.$blog->updated_at->diffForHumans()
                        : 'Saved '.$blog->updated_at->diffForHumans() }}
                </small>

                <div class="flex space-x-2">
                    {{-- <a href="{{ route('blogs.edit', $blog->id) }}"
                       title="Edit Post"
                       class="text-indigo-600 hover:text-indigo-800 p-2 rounded-full hover:bg-indigo-50 transition duration-150">
                        ✏️
                    </a> --}}

             <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
    @csrf
    @method('DELETE')
    <button type="submit" style="color: red;">Delete</button>
</form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-500 text-sm">No blog posts found.</p>
    @endforelse
</section>



        {{-- galary section --}}
<section id="gallery-view" class="view-section space-y-5">
    <h2 class="sr-only">Galleries List</h2>

    @forelse($galleries as $gallery)
        <div style="
            background: #fff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-radius: 16px;
            padding: 1.5rem;
            transition: transform 0.3s, box-shadow 0.3s;
        " 
        onmouseover="this.style.transform='scale(1.01)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.15)';" 
        onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';">

            <div style="display: flex; align-items: flex-start; margin-bottom: 1rem;">

                <div style="flex-shrink: 0; width: 100px; height: 100px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-right: 1rem;">
                    @if($gallery->file_name)
                        <img src="{{ asset('storage/galaray/' . $gallery->file_name) }}" alt="{{ $gallery->title }}" style="width:100%; height:100%; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/100x100?text=No+Image" alt="No Image" style="width:100%; height:100%; object-fit: cover;">
                    @endif
                </div>

                <div style="flex-grow: 1;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <h3 style="font-weight: 800; font-size: 1.125rem; color: #111827; max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $gallery->title }}
                            </h3>
                            <p style="font-size: 0.875rem; color: #6B7280; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin-top: 0.25rem;">
                                {{ $gallery->description }}
                            </p>
                        </div>

                        <span style="
                            font-size: 0.75rem;
                            font-weight: 800;
                            padding: 0.25rem 0.75rem;
                            border-radius: 9999px;
                            background-color: {{ $gallery->status == 'active' ? '#EDE9FE' : '#FEF3C7' }};
                            color: {{ $gallery->status == 'active' ? '#7C3AED' : '#B45309' }};
                            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                            flex-shrink: 0;
                        ">
                            {{ ucfirst($gallery->status) }}
                        </span>
                    </div>
                </div>

            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid #E5E7EB;">
                <small style="font-size: 0.75rem; color: #9CA3AF;">
                    {{ $gallery->created_at->diffForHumans() }}
                </small>

            <div style="display: flex; gap: 0.5rem;">

    <!-- Edit Button -->
    {{-- <a href="{{ route('gallery.edit', $item->id) }}" 
       title="Edit Gallery" 
       style="color:#7C3AED; padding:0.5rem; border-radius:9999px; background:none; cursor:pointer; text-decoration:none; display:flex; align-items:center; justify-content:center;">
        ✏️
    </a> --}}

    <!-- Delete Button -->
    <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" 
          onsubmit="return confirm('Are you sure you want to delete this image?');">
        @csrf
        @method('DELETE')
        <button type="submit" 
                title="Delete Gallery" 
                style="color:#DC2626; padding:0.5rem; border-radius:9999px; background:none; cursor:pointer; display:flex; align-items:center; justify-content:center;">
            🗑️
        </button>
    </form>

</div>

            </div>

        </div>
    @empty
        <p style="color:#6B7280;">No galleries available.</p>
    @endforelse
</section>

{{-- message --}}
<section id="messages-view" class="view-section" style="margin-bottom: 2rem;">

    <h2 style="font-size: 1.75rem; font-weight: 900; color: #111827; margin-bottom: 1.25rem;">💬 Messages Inbox</h2>

    @forelse($messages as $message)
        <div style="
            background: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 16px;
            padding: 1.5rem;
            border-left: 6px solid #6366F1;
            margin-bottom: 1rem;
        ">
            <h3 style="font-weight: 800; color: #111827;">{{ $message->subject }}</h3>
            <p style="font-size: 0.875rem; color: #6B7280; margin-top: 0.25rem;">
                {{ $message->message }}
            </p>
            <small style="font-size: 0.75rem; color: #9CA3AF; display: block; margin-top: 0.5rem;">
                From: {{ $message->fullname }} | {{ $message->email }} | {{ $message->phone ?? 'N/A' }} <br>
                {{ $message->created_at->diffForHumans() }}
            </small>
        </div>
    @empty
        <p style="color: #6B7280;">No messages yet.</p>
    @endforelse

</section>


    </div>
    
    <button id="open-creation-fab" class="main-fab text-white p-4 rounded-full fixed bottom-20 right-6 z-40" title="Create New Content">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
        </svg>
    </button>


    <nav class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-100 shadow-2xl">
        <div class="flex justify-around items-center h-20">
            
            <button id="nav-post" data-view="post-view" class="nav-btn active flex flex-col items-center justify-center p-2 text-indigo-600 h-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.586a2 2 0 012.828 0l1.414 1.414a2 2 0 010 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span class="text-xs mt-1 font-extrabold">Post</span>
            </button>
            
            <button id="nav-gallery" data-view="gallery-view" class="nav-btn flex flex-col items-center justify-center p-2 text-gray-500 hover:text-indigo-600 h-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-xs mt-1 font-extrabold">Gallery</span>
            </button>

            <button id="nav-messages" data-view="messages-view" class="nav-btn flex flex-col items-center justify-center p-2 text-gray-500 hover:text-indigo-600 h-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <span class="text-xs mt-1 font-extrabold">Messages</span>
            </button>
        </div>
    </nav>
    {{-- blog create --}}
    <div id="create-post-dialog" class="dialog-modal" aria-modal="true" role="dialog">
        <div class="bg-white rounded-2xl shadow-3xl p-8 relative dialog-container">
            
            <div class="flex justify-between items-center pb-4 mb-6 border-b border-gray-100">
                <h3 class="text-3xl font-extrabold text-gray-900">New Blog Post ✍️</h3>
                <button id="close-post-dialog" class="text-gray-400 hover:text-gray-600 transition p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

  <form class="space-y-6" 
      action="{{ route('blogs.store') }}" 
      method="POST" 
      enctype="multipart/form-data">
    
    @csrf

    <div>
        <label for="modal-post-title" class="block text-sm font-extrabold text-gray-700 mb-2">
            Title
        </label>
        <input 
            type="text" 
            name="title"
            id="modal-post-title" 
            placeholder="A catchy title..." 
            class="block w-full awesome-input"
            value="{{ old('title') }}"
            required
        >
    </div>

    <div>
        <label for="modal-post-content" class="block text-sm font-extrabold text-gray-700 mb-2">
            Content
        </label>
        <textarea 
            name="content"
            id="modal-post-content" 
            rows="6" 
            placeholder="Start writing your masterpiece..." 
            class="block w-full awesome-input resize-y"
            required
        >{{ old('content') }}</textarea>
    </div>

    <div>
        <label for="modal-post-file" class="block text-sm font-extrabold text-gray-700 mb-2">
            Cover Image
        </label>
        <input 
            id="modal-post-file" 
            type="file" 
            name="image"
            class="block w-full text-sm text-gray-500 awesome-input py-2"
        >
    </div>

    <button 
        type="submit" 
        class="w-full bg-indigo-600 text-white font-extrabold tracking-wide py-4 rounded-xl hover:bg-indigo-700 transition shadow-lg hover:shadow-xl transform hover:scale-[1.005]">
        Publish Draft
    </button>
</form>

        </div>
    </div>

    <div id="create-gallery-dialog" class="dialog-modal" aria-modal="true" role="dialog">
        <div class="bg-white rounded-2xl shadow-3xl p-8 relative dialog-container">
            
            <div class="flex justify-between items-center pb-4 mb-6 border-b border-gray-100">
                <h3 class="text-3xl font-extrabold text-gray-900">New Image Gallery 🖼️</h3>
                <button id="close-gallery-dialog" class="text-gray-400 hover:text-gray-600 transition p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

      

{{-- galary stroe --}}
<form action="{{ route('galaray.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    <div>
        <label for="modal-gallery-title" class="block text-sm font-extrabold text-gray-700 mb-2">Gallery Title</label>
        <input type="text" name="title" id="modal-gallery-title" placeholder="Vacation Album" class="block w-full awesome-input" required>
    </div>
    <div>
        <label for="modal-gallery-description" class="block text-sm font-extrabold text-gray-700 mb-2">Description</label>
        <textarea name="description" id="modal-gallery-description" rows="4" placeholder="Describe the images..." class="block w-full awesome-input resize-y"></textarea>
    </div>
    <div>
        <label for="modal-gallery-files" class="block text-sm font-extrabold text-gray-700 mb-2">Select Images</label>
     <input name="image" id="modal-gallery-files" type="file" class="block w-full text-sm text-gray-500 awesome-input py-2" required>

    </div>
    
    <button type="submit" class="w-full bg-purple-600 text-white font-extrabold tracking-wide py-4 rounded-xl hover:bg-purple-700 transition shadow-lg hover:shadow-xl transform hover:scale-[1.005]">
        Create Gallery
    </button>
</form>


        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navButtons = document.querySelectorAll('.nav-btn');
            const viewSections = document.querySelectorAll('.view-section');
            const statusText = document.getElementById('status-text');
            const fabButton = document.getElementById('open-creation-fab');

            const postDialog = document.getElementById('create-post-dialog');
            const closePostDialog = document.getElementById('close-post-dialog');

            const galleryDialog = document.getElementById('create-gallery-dialog');
            const closeGalleryDialog = document.getElementById('close-gallery-dialog');

            let currentViewId = 'post-view'; 

            // Function to open/close the dialog modal
            const toggleDialog = (dialog, shouldOpen) => {
                if (shouldOpen) {
                    dialog.classList.add('open');
                    document.body.style.overflow = 'hidden'; 
                } else {
                    dialog.classList.remove('open');
                    document.body.style.overflow = '';
                }
            };
            
            // Function to switch the main content view
            const switchView = (targetViewId) => {
                currentViewId = targetViewId;

                // 1. Hide all sections
                viewSections.forEach(section => section.classList.remove('active'));

                // 2. Show the target section
                document.getElementById(targetViewId).classList.add('active');

                // 3. Update active button styles
                navButtons.forEach(btn => {
                    btn.classList.remove('active', 'text-indigo-600');
                    btn.classList.add('text-gray-500');
                    if (btn.getAttribute('data-view') === targetViewId) {
                        btn.classList.add('active', 'text-indigo-600');
                        btn.classList.remove('text-gray-500');
                    }
                });

                // 4. Update top bar text and FAB color/visibility
                let viewTitle = targetViewId.replace('-view', '');
                statusText.textContent = viewTitle.charAt(0).toUpperCase() + viewTitle.slice(1);
                
                if (targetViewId === 'messages-view') {
                    // Hide FAB for Messages view
                    fabButton.style.display = 'none'; 
                } else {
                    // Show FAB for Post/Gallery views
                    fabButton.style.display = 'block'; 
                    fabButton.setAttribute('data-target-dialog', targetViewId === 'post-view' ? 'create-post-dialog' : 'create-gallery-dialog');
                    
                    // Change FAB color - Removed old classes and rely on CSS custom properties for gradient
                    // Note: Since Tailwind doesn't easily handle CSS gradients/image backgrounds in utilities, the FAB color change logic is now simplified. 
                    // The gradient is controlled by the .main-fab class in the <style> block, providing the consistent awesome look.
                }
            };

            // --- Event Listeners ---

            // Navigation Buttons (Switch View)
            navButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    switchView(e.currentTarget.getAttribute('data-view'));
                });
            });

            // FAB (Floating Action Button) -> Opens Dialog
            fabButton.addEventListener('click', () => {
                if (currentViewId === 'post-view') {
                    toggleDialog(postDialog, true);
                } else if (currentViewId === 'gallery-view') {
                    toggleDialog(galleryDialog, true);
                }
            });

            // Dialog Close Buttons
            closePostDialog.addEventListener('click', () => toggleDialog(postDialog, false));
            closeGalleryDialog.addEventListener('click', () => toggleDialog(galleryDialog, false));

            // Close dialog when clicking the modal backdrop
            [postDialog, galleryDialog].forEach(dialog => {
                dialog.addEventListener('click', (e) => {
                    if (e.target === dialog) {
                        toggleDialog(dialog, false);
                    }
                });
            });

            // Initialize to the Post View
            switchView('post-view'); 
        });
    </script>
    
</body>
</html>