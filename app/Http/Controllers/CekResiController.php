<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use App\Models\paket;
use App\Models\user;
use App\Models\kurir;
use App\Models\ekspedisi;
use App\Http\Resources\CekResiResource;


class CekResiController extends Controller
{

    public function __construct(CekResiResource $cekResiResource)
    {
        $this->cekResiResource = $cekResiResource;
    }

    public function track(Request $request)
    {
        

            $kurir = Auth::guard('kurir')->user();
            if (!$kurir) {
                return response()->json(['status' => 'error', 'message' => 'Kurir tidak terautentikasi'], 401);
            }

            $awb = $request->input('awb');
            if (empty($awb)) {
                return response()->json(['status' => 'error', 'message' => 'AWB tidak boleh kosong'], 400);
            }
            $courier_id = $request->input('courier');
            if (empty($courier_id)) {
                return response()->json(['status' => 'error', 'message' => 'courier tidak boleh kosong'], 400);
            }
            $ekspedisi = ekspedisi::find($courier_id);
            if (!$ekspedisi) {
                return response()->json(['status' => 'error', 'message' => 'Ekspedisi tidak ditemukan'], 404);
            }

            $courier = $ekspedisi->courier;

            try {
                $response = Http::get('https://api.binderbyte.com/v1/track', [
                        'api_key' => '3cb0c44123732816829630ba6928e87716faf01009799dd62b5aa78608fd653d',
                        'courier' => $courier,
                        'awb' => $awb,
                ]);
    
                     $data = json_decode($response->getBody(), true);
                // return $data = $response->json();
    
                
                    if ($data['status'] == 200) {
                        return response()->json([
                            'status' => 'success',
                            'nama' => $data['data']['detail']['receiver'],
                        ]);
                    } else {
                        return response()->json(['status' => 'error', 'message' => 'Resi tidak ditemukan']);
                    }
                
    
            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    return json_decode($e->getResponse()->getBody()->getContents(), true);
                }
    
                return ['error' => 'Request failed'];
            }

        // $data = $this->cekResiResource->trackShipment($courier, $awb);

        // return response()->json($data);
        
        // try {
        //     // Data sederhana untuk tes
        //     $data = [
        //         'status' => 200,
        //         'data' => [
        //             'detail' => [
        //                 'receiver' => 'John Doe',
        //             ]
        //         ]
        //     ];

        //     return response()->json([
        //         'status' => 'success',
        //         'nama' => $data['data']['detail']['receiver'],
                
        //     ]);

        // } catch (\Exception $e) {
        //     Log::error('Error in track method', ['exception' => $e]);
        //     return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan pada server'], 500);
        // }
    
    }
}
