<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{


    protected $routeMiddleware = [
        'checkKurir' => \App\Http\Middleware\CheckKurir::class,
        'checkSekuriti' => \App\Http\Middleware\CheckSekuriti::class,
    ];


}