<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('sekuriti.register.index', [
            'title' => 'Register',
            'active' => 'register'

        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:3'
        ]);

        User::create($validateData);

        $request->session()->flash('success', 'Registration was successfull! Please Login');

        return redirect('/sekuriti/login');
    }
}
