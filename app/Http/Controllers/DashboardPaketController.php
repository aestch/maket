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
            ->select('pakets.*', 'ekspedisis.jenis_ekspedisi', 'ekspedisis.courier')
            ->where('pakets.status', 'belum diambil')
            ->orderBy('pakets.created_at', 'desc') // Urutkan berdasarkan kolom created_at secara descending
            ->get();

        return view('sekuriti.dashboard.index', [
        'pakets' => $pakets,
        'Users' => User::all()
        ]);
    }

    public function histori()
    {
        $pakets = DB::table('pakets')
            ->join('ekspedisis', 'pakets.ekspedisi', '=', 'ekspedisis.id')
            ->select('pakets.*', 'ekspedisis.jenis_ekspedisi')
            ->where('pakets.status', 'sudah diambil') // Hanya ambil paket dengan status "sudah diambil"
            ->orderBy('pakets.created_at', 'desc') // Urutkan berdasarkan kolom created_at secara descending
            ->get();
        return view('sekuriti.dashboard.paket.histori', [
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
    public function updateStatus(Request $request, $id)
    {
        $status = $request->input('status');
        DB::table('pakets')
            ->where('id', $id)
            ->update(['status' => $status]);

        return redirect()->back()->with('success', 'Status paket berhasil diubah.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   

        $paket = paket::findOrFail($id);
        $ekspedisis = ekspedisi::all();

        return view('sekuriti.dashboard.paket.edit', compact('paket', 'ekspedisis'));

      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) 
    {
        $request->validate([
            'awb' => 'required|string',
            'ekspedisi' => 'required',
            'no_telepon' => 'required',
            'nama' => 'required|string',
            'no_rak' => 'required|string',
            'status' => 'required|string|in:sudah diambil,belum diambil',
        ]);

        $paket = paket::findOrFail($id);
        $paket->update($request->all());

        return redirect('/sekuriti/dashboard')->with('success', 'paket berhasil diubah.');
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

        return redirect('/sekuriti/dashboard')->with('deleted', 'Paket Berhasil dihapus');
    }

    
}
