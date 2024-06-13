<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kurir;
use App\Models\ekspedisi;
use Illuminate\Support\Facades\Auth;

class KurirLoginController extends Controller
{
    public function index()
    {
        return view('kurir.login.index', [
            'title' => 'Login'
        ]);
    }

    public function auth_proc(Request $request)
    {
        $credentials = $request->validate([
            'nama' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('kurir')->attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->intended('/kurir/dashboard/paket/create');
        }

        return back()->with('loginError', 'Login Failed!');

    }

    public function logout(Request $request)
    {
        Auth::guard('kurir')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
