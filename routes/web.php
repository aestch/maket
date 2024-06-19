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


Route::get('/', function () {
    return redirect('/home');
});
Route::get('/kurir', function () {
    return redirect('/kurir/login');
});



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
    Route::get('/kurir/login', [KurirLoginController::class, 'index']);
    Route::post('/kurir/login', [KurirLoginController::class, 'auth_proc']);
    Route::get('/kurir/register', [KurirRegisterController::class, 'index']);
    Route::post('/kurir/register', [KurirRegisterController::class, 'store']);
    Route::post('/kurir/logout', [KurirLoginController::class, 'logout'])->name('logout');


#SEKURITI
Route::group(['middleware' => ['auth:web',]], function () {
    Route::post('/sekuriti/logout', [LoginController::class, 'logout']);
    Route::resource('/sekuriti/dashboard', DashboardPaketController::class);
    Route::resource('/sekuriti/dashboard/paket', DashboardPaketController::class);
    Route::get('/sekuriti/dashboard/paket/{id}/edit', [DashboardPaketController::class, 'edit'])->name('sekuriti.paket.edit');
    Route::get('/sekuriti/dashboard/paket/{id}/delete', [DashboardPaketController::class, 'destroy'])->name('sekuriti.paket.destroy');
    Route::PUT('/sekuriti/dashboard/paket/{id}/edit', [DashboardPaketController::class, 'update'])->name('sekuriti.paket.update');
    Route::patch('/sekuriti/dashboard/paket/{id}/edit', [DashboardPaketController::class, 'updateStatus'])->name('sekuriti.paket.updateStatus');
    Route::get('/sekuriti/dashboard', [DashboardPaketController::class, 'index']);
    });
    
    Route::get('/sekuriti/dashboard/paket/histori', [DashboardPaketController::class, 'histori'])->name('sekuriti.paket.histori');
#KURIR
Route::group(['middleware' => ['auth:kurir']], function () {
    Route::resource('/kurir/dashboard', KurirPaketController::class );
    Route::resource('/kurir/dashboard/paket', KurirPaketController::class);
    Route::resource('/kurir/dashboard/histori', KurirPaketController::class);
    });
    Route::get('/kurir/dashboard', [KurirPaketController::class, 'index'])->name('kurir.dashboard.index');
    Route::get('/kurir/dashboard/paket/create', [KurirPaketController::class, 'create'])->name('kurir.paket.create');
    Route::post('/kurir/dashboard/paket', [KurirPaketController::class, 'store'])->name('kurir.paket.store');
    Route::get('/kurir/dashboard/histori', [KurirPaketController::class, 'histori'])->name('kurir.dashboard.histori');
    Route::get('/kurir/cek-resi', [CekResiController::class, 'track'])->name('kurir.cek-resi');
    Route::post('/kurir/cek-resi', [CekResiController::class, 'track'])->name('kurir.cek-resi');

Route::resource('/', HomeController::class);


// Route::get('/track-shipment', [CekResiController::class, 'track']);