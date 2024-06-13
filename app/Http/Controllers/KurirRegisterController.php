<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kurir;
use App\Models\ekspedisi;

class KurirRegisterController extends Controller
{
    public function index()
    {
        return view('kurir.register.index', [
            'title' => 'Register',
            'active' => 'register',
            'ekspedisis' => ekspedisi::all(),
            'kurirs' => kurir::all()

        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:255',
            'password' => 'required|min:3',
            'ekspedisi_id' => 'required'

        ]);


        kurir::create($validateData);

       
        $request->session()->flash('success', 'Registration was successfull! Please Login');

        return redirect('/kurir/login');
    }
}
