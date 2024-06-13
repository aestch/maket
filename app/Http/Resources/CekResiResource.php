<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class CekResiResource extends JsonResource
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('services.binderbyte.url');
        $this->apiKey = config('services.binderbyte.key');
    }

    public function trackShipment($courier, $awb)
    {
        try {
            $response = $this->client->request('GET', $this->baseUrl, [
                'query' => [
                    'api_key' => $this->apiKey,
                    'courier' => $courier,
                    'awb' => $awb,
                ],
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

        // try {

        // Ganti URL dan parameter API sesuai dengan kebutuhan Anda
        // $response = $this->client->request('GET', $this->baseUrl, [
        //     'api_key' => '3cb0c44123732816829630ba6928e87716faf01009799dd62b5aa78608fd653d', // Ganti dengan API key yang benar
        //     'courier' => $courier, // Mengambil courier dari data ekspedisi
        //     'awb' => $awb
        // ]);
        
        // $data = $response->json();

        // return json_decode($response->getBody(), true);


        // if ($response->successful()) {
        //     $data = $response->json();
        //     if ($data['status'] == 200) {
        //         return response()->json([
        //             'status' => 'success',
        //             'nama' => $data['data']['detail']['receiver'],
        //         ]);
        //     } else {
        //         return response()->json(['status' => 'error', 'message' => 'Resi tidak ditemukan']);
        //     }
        // } else {
        //     Log::error('API request failed', ['response' => $response->body()]);
        //     return response()->json(['status' => 'error', 'message' => 'API gagal dihubungi'], 500);
        // }
        // } catch (\Exception $e) {
        //     Log::error('Error in track method', ['exception' => $e]);
        //     return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan pada server'], 500);
        // }

        // } catch (RequestException $e) {
        // if ($e->hasResponse()) {
        //     return json_decode($e->getResponse()->getBody()->getContents(), true);
        //     }
        // return ['error' => 'Request failed'];
        // } 
    }  
    
}
