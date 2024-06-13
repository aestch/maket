<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ekspedisi;
class EkspedisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ekspedisi1= ekspedisi::create([
            'jenis_ekspedisi' => 'JNE',
            'courier' => 'jne'
        ]);
        $ekspedisi2= ekspedisi::create([
            'jenis_ekspedisi' => 'Pos Indonesia',
            'courier' => 'pos'
        ]);
        $ekspedisi3= ekspedisi::create([
            'jenis_ekspedisi' => 'JNT',
            'courier' => 'jnt'
        ]);
        $ekspedisi4= ekspedisi::create([
            'jenis_ekspedisi' => 'JNT Cargo',
            'courier' => 'jnt_cargo'
        ]);
        $ekspedisi5= ekspedisi::create([
            'jenis_ekspedisi' => 'SiCepat',
            'courier' => 'sicepat'
        ]);
        $ekspedisi6= ekspedisi::create([
            'jenis_ekspedisi' => 'Tiki',
            'courier' => 'tiki'
        ]);
        $ekspedisi7= ekspedisi::create([
            'jenis_ekspedisi' => 'Anter Aja',
            'courier' => 'anteraja'
        ]);
        $ekspedisi8= ekspedisi::create([
            'jenis_ekspedisi' => 'Wahana',
            'courier' => 'wahana'
        ]);
        $ekspedisi9= ekspedisi::create([
            'jenis_ekspedisi' => 'ID Express',
            'courier' => 'ide'
        ]);
        $ekspedisi11= ekspedisi::create([
            'jenis_ekspedisi' => 'Shopee Express',
            'courier' => 'spx'
        ]);
        $ekspedisi12= ekspedisi::create([
            'jenis_ekspedisi' => 'Lainnya',
            'courier' => 'tidakada'
        ]);
       
    }
}
