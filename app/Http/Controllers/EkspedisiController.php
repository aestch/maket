<?php

namespace App\Http\Controllers;

use App\Models\ekspedisi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


class EkspedisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sekuriti.dashboard.ekspedisi.index', [
            'ekspedisis' => ekspedisi::all(),
            'Users' => User::all()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sekuriti.dashboard.ekspedisi.create', [
            'ekspedisis' => ekspedisi::all(),
            'Users' => User::all()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'jenis_ekspedisi' => 'required',
            'courier' => 'required'
        ]);

        $ekspedisi = ekspedisi::create($validatedData);

        return redirect('sekuriti/dashboard/ekspedisi')->with('success', 'Ekspedisi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(ekspedisi $ekspedisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ekspedisi = ekspedisi::findOrFail($id);
 

        return view('sekuriti.dashboard.ekspedisi.edit', compact('ekspedisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_ekspedisi' => 'required',
            'courier' => 'required'
        ]);

        $ekspedisi = ekspedisi::findOrFail($id);
        $ekspedisi->update($request->all());

        return redirect('/sekuriti/dashboard/ekspedisi')->with('success', 'ekspedisi berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ekspedisi = ekspedisi::findOrFail($id);

        //delete image
        //delete post
        $ekspedisi->delete();

        // ekspedisi::where('id', $ekspedisi)->delete();

        return redirect('/sekuriti/dashboard/ekspedisi')->with('deleted', 'Paket Berhasil dihapus');
    }
}
