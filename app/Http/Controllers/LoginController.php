<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('sekuriti.login.index', [
            'title' => 'Login',
            'Users' => User::all()
        ]);
    }

    public function authenticate(Request $request)
    {
        $remember = $request->has('remember');
        
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);


        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/sekuriti/dashboard');
        }

        $request->session()->put('email', $request->input('email'));

        return back()->with('loginError', 'Login Failed!');

    }

    public function logout(Request $request)
    {
        
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to the home page or login page
        return redirect('/');
    }
}
