<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ekspedisi extends Model
{
    use HasFactory; 

    public function kurirs()
    {
        return $this->hasMany(kurir::class);
        return $this->hasMany(paket::class);
    }
}
