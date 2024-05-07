<?php

namespace App\Http\Controllers;

use App\Models\paket;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
        return view('dashboard.index', [
            'pakets' => paket::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.paket.create', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'pemilik' => 'required',
            'no_rak' => 'required',
            'instansi' => 'required',
            'keterangan' => 'required'
        ]);

        // dd($validatedData);
        // return dd($validatedData);
        $paket = paket::create($validatedData);

        return redirect('/dashboard')->with('success', 'Paket Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(paket $paket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, paket $paket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $paket = paket::findOrFail($id);

        //delete image
        //delete post
        $paket->delete();

        // paket::where('id', $paket)->delete();

        return redirect('/dashboard')->with('deleted', 'Paket Berhasil dihapus');
    }
}
