<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\ContactFormSubmition;
use App\Models\Galaray;
use App\Models\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ActionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Contact Form
    |--------------------------------------------------------------------------
    */
    public function submitContactForm(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'nullable|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'nullable|string|max:50',
            'subject'  => 'nullable|string|max:255',
            'message'  => 'nullable|string',
        ]);

        ContactFormSubmition::create($data);

        return back()->with('success', 'Your message has been sent successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | Gallery - CREATE
    |--------------------------------------------------------------------------
    */
    public function submitGalaryForm(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $fileName = $this->uploadImage($request->image, 'galaray');

        Galaray::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_name' => $fileName,
            'status' => 'active',
            'published_at' => now(),
        ]);

        return back()->with('success', 'Gallery image uploaded successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | Gallery - UPDATE
    |--------------------------------------------------------------------------
    */
    public function updateGallery(Request $request, $id)
    {
        $gallery = Galaray::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteImage('galaray/' . $gallery->file_name);
            $gallery->file_name = $this->uploadImage($request->image, 'galaray');
        }

        $gallery->update($request->only('title', 'description'));

        return back()->with('success', 'Gallery updated successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | Gallery - DELETE
    |--------------------------------------------------------------------------
    */
    public function deleteGallery($id)
    {
        $gallery = Galaray::findOrFail($id);
        $this->deleteImage('galaray/' . $gallery->file_name);
        $gallery->delete();

        return back()->with('success', 'Gallery deleted successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | Blog - CREATE
    |--------------------------------------------------------------------------
    */
    public function createBlogPost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tags' => 'nullable|string|max:255',
        ]);

        $imageName = $request->hasFile('image')
            ? $this->uploadImage($request->image, 'blog')
            : null;

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'image' => $imageName,
            'status' => 'published',
            'tags' => $request->tags,
        ]);

        return back()->with('success', 'Blog post created successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | Blog - UPDATE
    |--------------------------------------------------------------------------
    */
    public function updateBlogPost(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tags' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteImage('blog/' . $blog->image);
            $blog->image = $this->uploadImage($request->image, 'blog');
        }

        $blog->update($request->only('title', 'content', 'author', 'tags'));

        return back()->with('success', 'Blog updated successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | Blog - DELETE
    |--------------------------------------------------------------------------
    */
    public function deleteBlogPost($id)
    {
        $blog = Blog::findOrFail($id);
        $this->deleteImage('blog/' . $blog->image);
        $blog->delete();

        return back()->with('success', 'Blog deleted successfully!');
    }




    //   Slider Form Submission
 public function submitSliderForm(Request $request)
{
    // 1. Validation (Matches your style but adds slider-specific fields)
    $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'required|string',
        'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'link'        => 'nullable|string',
        'order'       => 'nullable|integer',
    ]);

    // 2. Upload Image (Using your custom $this->uploadImage method)
    // This assumes your helper saves to 'public/sliders'
    $fileName = $this->uploadImage($request->image, 'sliders');

    // 3. Create Slider Record
    Sliders::create([
        'title'       => $request->title,
        'description' => $request->description,
        'image'       => $fileName,
        'link'        => $request->link,
        'order'       => $request->order ?? 0,
        'is_active'   => true, // Default to active
    ]);

    // 4. Return back to the blade template with success toast
    return back()->with('success', 'New hero slide published successfully!');
}


    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */
    private function uploadImage($file, $folder)
    {
        $path = public_path($folder);

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $name = time() . '_' . Str::random(10) . '.' . $file->extension();
        $file->move($path, $name);

        return $name;
    }

    private function deleteImage($path)
    {
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
