<?php

namespace App\Http\Controllers;

use App\Models\paket;
use App\Models\User;
use App\Models\ekspedisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
        $pakets = DB::table('pakets')
            ->join('ekspedisis', 'pakets.ekspedisi', '=', 'ekspedisis.id')
            ->select('pakets.*', 'ekspedisis.*')
            ->orderBy('pakets.created_at', 'desc') // Urutkan berdasarkan kolom created_at secara descending
            ->get();

        return view('sekuriti.dashboard.index', [
        'pakets' => $pakets,
        'Users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sekuriti.dashboard.paket.create', [
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

        $paket = paket::create($validatedData);

        return redirect('/sekuriti/dashboard')->with('success', 'Paket Berhasil Ditambahkan');
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
        return view('dashboard.paket.edit', [
            'paket' => $paket
        ]);

      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, paket $paket, $id) 
    {
         $request->validate([
            'pemilik' => 'required',
            'no_rak' => 'required',
            'instansi' => 'required',
            'keterangan' => 'required'
        ]);


        $paket = paket::findOrFail($id);

        $paket->update([
            'pemilik' => $request->pemilik,
            'no_rak' => $request->no_rak,
            'instansi' => $request->instansi,
            'keterangan' => $request->keterangan
        ]);


        return redirect('/dashboard')->with('success', 'Paket Berhasil Diedit');
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
