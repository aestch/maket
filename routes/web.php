<?php

use Illuminate\Support\Facades\Route; 
use Illuminate\Auth\Events\Login;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPaketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeSearchController;
use App\Http\Controllers\CekResiController;
use App\Http\Controllers\KurirLoginController;
use App\Http\Controllers\KurirRegisterController;
use App\Http\Controllers\KurirPaketController;
use App\Http\Controllers\EkspedisiController;


Route::get('/', function () {
    return redirect('/home');
});
Route::get('/kurir', function () {
    return redirect('/kurir/login');
});


Route::get('/sekuriti/dashboard/paket/histori', [DashboardPaketController::class, 'histori'])->name('sekuriti.paket.histori')->middleware('auth:web');
Route::get('/kurir/dashboard/paket/histori', [KurirPaketController::class, 'histori'])->name('kurir.paket.histori')->middleware('auth:kurir');

    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/home/histori', [HomeController::class, 'histori']);
    Route::post('/home/search', [HomeSearchController::class, 'index']);
    Route::post('/home/search', [HomeSearchController::class, 'search'])->name('search.perform');
    
    #SEKURITI
    Route::get('/sekuriti/login', [LoginController::class, 'index']);
    Route::post('/sekuriti/login', [LoginController::class, 'authenticate'])->name('authenticate.sekuriti');
    Route::get('/sekuriti/register', [RegisterController::class, 'index']);
    Route::post('/sekuriti/register', [RegisterController::class, 'store']);


    #KURIR
    Route::get('/kurir/login', [KurirLoginController::class, 'index'])->name('login');
    Route::post('/kurir/login', [KurirLoginController::class, 'auth_proc']);
    Route::get('/kurir/register', [KurirRegisterController::class, 'index']);
    Route::post('/kurir/register', [KurirRegisterController::class, 'store']);
    Route::post('/kurir/logout', [KurirLoginController::class, 'logout'])->name('logout');


#SEKURITI
Route::group(['middleware' => ['auth:web',]], function () {
    Route::post('/sekuriti/logout', [LoginController::class, 'logout']);
    Route::get('/sekuriti/dashboard', [DashboardPaketController::class, 'index']);
    Route::get('/sekuriti/dashboard/ekspedisi', [EkspedisiController::class, 'index'])->name('sekuriti.dashboard.ekspedisi');
    Route::resource('/sekuriti/dashboard', DashboardPaketController::class);
    Route::resource('/sekuriti/dashboard/paket', DashboardPaketController::class);
    Route::resource('/sekuriti/dashboard/ekspedisi', EkspedisiController::class);
    Route::get('/sekuriti/dashboard/ekspedisi/create', [EkspedisiController::class, 'create'])->name('sekuriti.ekspedisi.create');
    Route::get('/sekuriti/dashboard/ekspedisi/{id}/edit', [EkspedisiController::class, 'edit'])->name('sekuriti.ekspedisi.edit');
    Route::get('/sekuriti/dashboard/ekspedisi/{id}/delete', [EkspedisiController::class, 'destroy'])->name('sekuriti.ekspedisi.destroy');
    Route::PUT('/sekuriti/dashboard/ekspedisi/{id}/edit', [EkspedisiController::class, 'update'])->name('sekuriti.ekspedisi.update');
    Route::get('/sekuriti/dashboard/paket/{id}/edit', [DashboardPaketController::class, 'edit'])->name('sekuriti.paket.edit');
    Route::get('/sekuriti/dashboard/paket/{id}/delete', [DashboardPaketController::class, 'destroy'])->name('sekuriti.paket.destroy');
    Route::PUT('/sekuriti/dashboard/paket/{id}/edit', [DashboardPaketController::class, 'update'])->name('sekuriti.paket.update');
    Route::patch('/sekuriti/dashboard/paket/{id}/edit', [DashboardPaketController::class, 'updateStatus'])->name('sekuriti.paket.updateStatus');
    Route::post('/sekuriti/dashboard/ekspedisi', [EkspedisiController::class, 'store'])->name('sekuriti.ekspedisi.store');

});
#KURIR
Route::group(['middleware' => ['auth:kurir']], function () {
    Route::resource('/kurir/dashboard', KurirPaketController::class );
    Route::resource('/kurir/dashboard/paket', KurirPaketController::class);
    Route::resource('/kurir/dashboard/histori', KurirPaketController::class);
    Route::get('/kurir/dashboard', [KurirPaketController::class, 'index'])->name('kurir.dashboard.index');
    Route::get('/kurir/dashboard/paket/create', [KurirPaketController::class, 'create'])->name('kurir.paket.create');
    Route::post('/kurir/dashboard/paket', [KurirPaketController::class, 'store'])->name('kurir.paket.store');
    Route::get('/kurir/cek-resi', [CekResiController::class, 'track'])->name('kurir.cek-resi');
    Route::post('/kurir/cek-resi', [CekResiController::class, 'track'])->name('kurir.cek-resi');
    });

Route::resource('/', HomeController::class);


// Route::get('/track-shipment', [CekResiController::class, 'track']);