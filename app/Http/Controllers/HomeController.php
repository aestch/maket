<?php

namespace App\Http\Controllers;

use App\Models\paket;
use App\Models\User;
use App\Models\ekspedisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {   
        $pakets = DB::table('pakets')
                    ->join('ekspedisis', 'pakets.ekspedisi', '=', 'ekspedisis.id')
                    ->select('pakets.*', 'ekspedisis.*')
                    ->orderBy('pakets.created_at', 'desc') // Urutkan berdasarkan kolom created_at secara descending
                    ->get();

        return view('home.index', [
            'pakets' => $pakets,
            'Users' => User::all()
            
        ]);
    }


}
