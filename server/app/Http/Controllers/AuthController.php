<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        return view('auth.login'); // Your login blade
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validate user input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $remember = $request->has('remember');

        // Attempt to login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // Prevent session fixation

            return redirect()->intended('/admin')->with('success', 'Welcome back!');
        }

        // Failed login
        return back()->withErrors([
            'email' => 'Invalid credentials, please try again.',
        ])->withInput($request->only('email', 'remember'));
    }

    /**
     * Logout the user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
