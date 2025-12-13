<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\ContactFormSubmition;
use App\Models\Galaray;
use Pest\Support\Str;
use Illuminate\Support\Facades\Storage;

class ActionController extends Controller
{

    public function submitContactForm(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        ContactFormSubmition::create($data);

        return back()->with('success', 'Your message has been sent successfully!');
    }



    public function submitGalaryForm(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $fileName = null;

        if ($request->hasFile('image')) {
            $fileName = time() . '_' . Str::random(10) . '.' . $request->image->extension();
            $request->image->storeAs('galaray', $fileName, 'public');
        }

        $galary =   Galaray::create([
            'title'        => $request->title,
            'description'  => $request->description,
            'file_name'    => $fileName,
            'status'       => 'active',
            'published_at' => $request->status === 'active' ? now() : null,
        ]);

        if ($galary) {
            return redirect()->back()->with('success', 'Gallery image uploaded successfully!');
        } else {
            return redirect()->back()->with('error', 'Somthing went wrong!');
        }
    }



    public function createBlogPost(Request $request)
    {

        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'author'  => 'nullable|string|max:100',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags'    => 'nullable|string|max:255',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . Str::random(10) . '.' . $request->image->extension();
            $request->image->storeAs('blog', $fileName, 'public');
            $imagePath = $fileName;
        }

        // Create blog post
        $blog = Blog::create([
            'title'   => $request->title,
            'content' => $request->content,
            'author'  => $request->author,
            'image'   => $imagePath,
            'status'  => 'published',
            'tags'    => $request->tags,
        ]);

        return redirect()->back()->with('success', 'Blog post created successfully!');
    }


  
}
