<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paket extends Model
{
    use HasFactory;
    protected $guarded = [''];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected static function booted()
    {
        static::updating(function ($paket) {
            $paket->updated_at = now();
        });
    }


    public function ekspedisi()
    {
        return $this->belongsTo(ekspedisi::class, 'ekspedisi');
    }   
}
