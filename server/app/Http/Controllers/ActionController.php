<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactFormSubmission;

class ActionController extends Controller
{
    /**
     * Handle contact form submission
     */
    public function submitContactForm(Request $request)
    {
        // Validate form data
        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save to database
        ContactFormSubmission::create($data);

        // Redirect back with success message
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
