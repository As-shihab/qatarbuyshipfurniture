<?php

use App\Http\Controllers\ActionController;
use App\Models\Blog;
use App\Models\ContactFormSubmition;
use App\Models\Galaray;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    $galleries = Galaray::orderBy('created_at', 'desc')->get();
  $blogs = Blog::orderBy('created_at', 'desc')->get();
    return view('welcome', compact(['galleries' , 'blogs']));
});


Route::delete('/blogs/{id}', function($id) {
    $blog = Blog::findOrFail($id);

    // Delete main image from storage
    if ($blog->image && Storage::exists('public/blog/' . $blog->image)) {
        Storage::delete('public/blog/' . $blog->image);
    }


    $blog->delete();

    return back()->with('success', 'Blog deleted successfully.');
})->name('blogs.destroy');


Route::get('/admin', function () {
    $messages = ContactFormSubmition::latest()->get();
    $galleries = Galaray::orderBy('created_at', 'desc')->get();
    $blogs = Blog::orderBy('created_at', 'desc')->get();
    return view('dashboard.admin', compact(['messages', 'galleries', 'blogs']));
});



Route::get('/blogs/{id}', function($id){
    $blog = Blog::findOrFail($id); 
    return view('pages.blog-view', compact('blog'));
})->name('blogs.show');




Route::delete('/gallery/{id}', function($id) {
    $image = Galaray::findOrFail($id);
    if ($image->file_name && Storage::exists('public/gallery/' . $image->file_name)) {
        Storage::delete('public/gallery/' . $image->file_name);
    }

    $image->delete();

    return back()->with('success', 'Image deleted successfully.');
})->name('gallery.destroy');



Route::post('/contact-submit', [ActionController::class, 'submitContactForm'])->name('contact.submit');
Route::post("/create-galary", [ActionController::class, 'submitGalaryForm'])->name('galaray.store');
Route::post("/create-blog", [ActionController::class, 'createBlogPost'])->name('blogs.store');
