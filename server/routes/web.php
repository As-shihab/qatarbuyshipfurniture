<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\AuthController;
use App\Models\Blog;
use App\Models\ContactFormSubmition;
use App\Models\Galaray;
use App\Models\Sliders;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Public Website Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $galleries = Galaray::latest()->get();
    $blogs = Blog::latest()->get();
    $sliders = Sliders::latest()->get();
    return view('welcome', compact('galleries', 'blogs', 'sliders'));
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Public Blog View
|--------------------------------------------------------------------------
*/

Route::get('/blogs/{id}', function ($id) {
    $blog = Blog::findOrFail($id);
    return view('pages.blog-view', compact('blog'));
})->name('blogs.show');

/*
|--------------------------------------------------------------------------
| Admin Panel (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->group(function () {

    /*
    | Dashboard
    */
    Route::get('/', function () {
        return view('dashboard.admin', [
            'messages'  => ContactFormSubmition::latest()->get(),
            'galleries' => Galaray::latest()->get(),
            'blogs'     => Blog::latest()->get(),
        ]);
    })->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Blog Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/create-blog', function () {
        return view('dashboard.pages.blog-create');
    })->name('dashboard.create-blog');

    Route::get('/edit-blog/{id}', function ($id) {
        $blog = Blog::findOrFail($id);
        return view('dashboard.pages.blog-edit', compact('blog'));
    })->name('dashboard.edit-blog');

    Route::post('/blogs', [ActionController::class, 'createBlogPost'])
        ->name('admin.blogs.store');

    Route::put('/blogs/{id}', [ActionController::class, 'updateBlogPost'])
        ->name('admin.blogs.update');

    Route::delete('/blogs/{id}', [ActionController::class, 'deleteBlogPost'])
        ->name('admin.blogs.destroy');

    /*
    |--------------------------------------------------------------------------
    | Gallery Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/gallery', function () {
        $galleries = Galaray::latest()->get();
        return view('dashboard.gallery', compact('galleries'));
    })->name('admin.gallery.index');




    Route::post('/gallery', [ActionController::class, 'submitGalaryForm'])
        ->name('admin.gallery.store');

    Route::put('/gallery/{id}', [ActionController::class, 'updateGallery'])
        ->name('admin.gallery.update');

    Route::delete('/gallery/{id}', [ActionController::class, 'deleteGallery'])
        ->name('admin.gallery.destroy');

    // services

    Route::get('/services', function () {
        return view('dashboard.services');
    })->name('admin.services.index');


    Route::post('/services', [ActionController::class, 'submitServiceForm'])
        ->name('admin.services.store');

    Route::put('/services/{id}', [ActionController::class, 'updateService'])
        ->name('admin.services.update');

    Route::delete('/services/{id}', [ActionController::class, 'deleteService'])
        ->name('admin.services.destroy');



    // Sliders
    Route::get('/sliders', function () {
        $sliders = Sliders::latest()->get();
        return view('dashboard.sliders', compact('sliders'));
    })->name('admin.sliders.index');


    Route::post('/sliders', [ActionController::class, 'submitSliderForm'])
        ->name('admin.sliders.store');


    Route::put('/sliders/{id}', [ActionController::class, 'updateSlider'])
        ->name('admin.sliders.update');

    Route::delete('/sliders/{id}', function ($id) {
        $slider = Sliders::findOrFail($id);
        // Delete the image file from storage
        Storage::delete($slider->image);
        $slider->delete();
        return back()->with('success', 'Slider deleted successfully.');
    })->name('admin.sliders.destroy');



    /*
    |--------------------------------------------------------------------------
    | Contact Messages
    |--------------------------------------------------------------------------
    */


    Route::get('/contact-messages', function () {
        $messages = ContactFormSubmition::latest()->get();
        return view('dashboard.contact', compact('messages'));
    })->name('admin.contact-messages.index');



    Route::delete('/contact-messages/{id}', function ($id) {
        $message = ContactFormSubmition::findOrFail($id);
        $message->delete();
        return back()->with('success', 'Message deleted successfully.');
    })->name('admin.contact-messages.destroy');
});


Route::post('/contact-submit', [ActionController::class, 'submitContactForm'])
    ->name('contact.submit');
