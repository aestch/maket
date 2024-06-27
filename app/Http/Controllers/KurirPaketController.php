<?php

namespace App\Http\Controllers;

use App\Models\paket;
use App\Models\User;
use App\Models\kurir;
use App\Models\ekspedisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class KurirPaketController extends Controller
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

        return view('kurir.dashboard.index', [
            'pakets' => $pakets,
            'kurirs' => kurir::all(),
            'Users' => User::all()
        ]);
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kurir.dashboard.paket.create', [
            'pakets' => paket::all(),
            'kurirs' => kurir::all(),
            'Users' => User::all(),
            'ekspedisis' => ekspedisi::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'awb' => 'required|string',
            'ekspedisi' => 'required',
            'no_telepon' => 'required',
            'nama' => 'required|string',
            'no_rak' => 'required|string',
            'status' => 'required|string|in:sudah diambil,belum diambil',
        ]);

        paket::create([
            'awb' => $request->awb,
            'ekspedisi' => $request->ekspedisi,
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'no_rak' => $request->no_rak,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        $target = $request->input('no_telepon');
            if (empty($target)) {
                return response()->json(['status' => 'error', 'message' => 'Nomor Telepon tidak boleh kosong'], 400);
            }
        $nama= $request->input('nama');
            if (empty($nama)) {
                return response()->json(['status' => 'error', 'message' => 'Namatidak boleh kosong'], 400);
            }

            try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.fonnte.com/send',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array(
            'target' => $target,
            'message' => 'Halo! '. $nama .' Paket Anda telah datang, Silahkan cek di pemdal Tower A.', 
            'countryCode' => '62', //optional
            ),
              CURLOPT_HTTPHEADER => array(
                'Authorization: 2KpQuuXyJKLPN2zW3EXK' //change TOKEN to your actual token
              ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);

        return redirect()->route('kurir.dashboard.index')->with('success', 'Paket berhasil ditambahkan');

        } catch ( Exception $e ) {
            return redirect()->route('kurir.dashboard.index')->with('error', 'Paket berhasil ditambahkan, pesan wa tidak terkirim');
        }



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
    public function destroy(paket $paket)
    {
        //
    }

    public function histori()
    {
        $pakets = DB::table('pakets')
            ->join('ekspedisis', 'pakets.ekspedisi', '=', 'ekspedisis.id')
            ->select('pakets.*', 'ekspedisis.jenis_ekspedisi')
            ->where('pakets.status', 'sudah diambil') // Hanya ambil paket dengan status "sudah diambil"
            ->orderBy('pakets.created_at', 'desc') // Urutkan berdasarkan kolom created_at secara descending
            ->get();

        return view('kurir.dashboard.paket.histori', compact('pakets'));
    }
}
