<?php

namespace App\Http\Controllers;

use App\Models\paket;
use App\Models\User;
use App\Models\ekspedisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeSearchController extends Controller
{
    public function index()
    {
        
        $pakets = DB::table('pakets')
                    ->join('ekspedisis', 'pakets.ekspedisi', '=', 'ekspedisis.id')
                    ->select('pakets.*', 'ekspedisis.*')
                    ->orderBy('pakets.created_at', 'desc') // Urutkan berdasarkan kolom created_at secara descending
                    ->get();
                    
        return view('home.search', [
            'pakets' => $pakets,
            'Users' => User::all()
            
        ]);
    }

    public function search(Request $request)
    {
        // Ambil input pencarian
    $query = $request->input('query');

    // Query untuk join tabel pakets dan ekspedisis
    $pakets = DB::table('pakets')
            ->join('ekspedisis', 'pakets.ekspedisi', '=', 'ekspedisis.id')
            ->select('pakets.*', 'ekspedisis.jenis_ekspedisi')
            ->orderBy('pakets.created_at', 'desc') // Urutkan berdasarkan kolom created_at secara descending
            ->get();

    // Filter hasil join berdasarkan input pencarian
    $results = $pakets->filter(function ($paket) use ($query) {
        return stripos($paket->nama, $query) !== false;
    });

    // Kirim hasil pencarian ke view
    return view('home.search', compact('results', 'query'));

        // $query = $request->input('query');
        // // Lakukan pencarian di model, misalnya pada model paket
        // $results = paket::where('nama', 'LIKE', "%{$query}%")->get();
        
        // return view('home.Search', compact('results', 'query'));
    }

}
